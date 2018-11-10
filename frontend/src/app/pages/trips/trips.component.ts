import { Component, OnDestroy, OnInit } from '@angular/core';
import {
  DynamicDatePickerModel,
  DynamicFormModel,
  DynamicFormService,
  DynamicInputModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { TripService } from '../../service/trip.service';
import { SnotifyService } from 'ng-snotify';
import { RequestData } from '../../models/request-data';
import { ITrip } from '../../interface/itrip';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-trips',
  templateUrl: './trips.component.html',
  styleUrls: ['./trips.component.css']
})
export class TripsComponent implements OnInit, OnDestroy {
  data: Array<ITrip>;
  links: any;
  meta: any;
  filter: any = {};
  /**
   * used to define searchform
   */
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'From',
      maxLength: 42,
      placeholder: 'From: Ankara'
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'To',
      maxLength: 42,
      placeholder: 'To: Bishkek'
    }),
    new DynamicDatePickerModel({
      id: 'start_dt',
      label: 'From Date',
      placeholder: 'YYYY-MM-DD',
      toggleLabel: '#',
    }),
    new DynamicDatePickerModel({
      id: 'end_dt',
      label: 'To Date',
      placeholder: 'YYYY-MM-DD',
      toggleLabel: '#'
    }),
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  private valchange: Subscription;
  constructor(
    private trip: TripService,
    private formService: DynamicFormService,
    private notify: SnotifyService
  ) { }

  ngOnInit() {
    this.getAll({});
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(({ start_dt, end_dt, from_formatted_address, to_formatted_address }) => {
      this.filter.end_dt = end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`;
      this.filter.start_dt = start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`;
      this.filter.from_formatted_address = from_formatted_address;
      this.filter.to_formatted_address = to_formatted_address;
    });
  }
  /**
   * Finds trips component with given parameters
   */
  find() {
    this.getAll(this.filter);
  }
  /**
   * Gets all a function to make request with pagin and filtering
   * @param params
   */
  getAll(params) {
    this.trip.getAll(params).subscribe(
      (req: RequestData) => {
        this.data = req.data;
        this.links = req.links;
        this.meta = req.meta;
      },
      error => this.notify.error(error)
    );
  }
  /**
   * Pages change pagination onchange method
   * @param page
   */
  pageChange(page: Number) {
    this.getAll({ page, ...this.filter });
  }
  /**
   * on destroy will work when the compnent leave the dom
   */
  ngOnDestroy(): void {
    this.valchange.unsubscribe();
  }
}
