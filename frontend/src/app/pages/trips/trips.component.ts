import { Component, OnInit } from '@angular/core';
import {
  DynamicFormModel,
  DynamicFormService,
  DynamicInputModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { TripService } from '../../service/trip.service';
import { SnotifyService } from 'ng-snotify';
import { RequestData } from '../../models/request-data';
import { ITrip } from '../../interface/itrip';

@Component({
  selector: 'app-trips',
  templateUrl: './trips.component.html',
  styleUrls: ['./trips.component.css']
})
export class TripsComponent implements OnInit {
  data: Array<ITrip>;
  links: any;
  meta: any;
  filter: any;
  /**
   *used to define searchform
   * @type {DynamicFormModel}
   * @memberof TripsComponent
   */
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'carrier_id',
      label: 'carrier_id',
      maxLength: 42,
      placeholder: 'carrier_id'
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'to_formatted_address',
      maxLength: 42,
      placeholder: 'to_formatted_address'
    })
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  constructor(
    private trip: TripService,
    private formService: DynamicFormService,
    private notify: SnotifyService
  ) {}

  ngOnInit() {
    this.getAll({});
    this.formGroup = this.formService.createFormGroup(this.formModel);
  }
  /**
   * a funtion to get form data and make filter
   * @param {*} event - event ftom form
   * @memberof TripsComponent
   */
  onChange(event) {
    this.filter = event.group.value;
    this.getAll(this.filter);
  }
  /**
   * a function to make request with pagin and filtering
   * @param {*} params
   * @memberof TripsComponent
   */
  getAll(params) {
    this.trip.getAll(params).subscribe(
      (req: RequestData) => {
        this.data = req.data;
        this.links = req.links;
        this.meta = req.meta;
      },
      error => this.handleError(error)
    );
  }
  /**
   *used to notify errors from backend
   * @param {*} error
   * @returns {*}
   * @memberof TripsComponent
   */
  handleError(error): any {
    this.notify.error(error);
  }
  /**
   *pagination onchange method
   * @param {Number} pagin
   * @memberof TripsComponent
   */
  pageChange(pagin: Number) {
    this.getAll({ page: pagin, ...this.filter });
  }
}
