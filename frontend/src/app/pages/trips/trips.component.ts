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
  page: Number = 1;
  /**
   *used to define searchform
   */
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'sampleInput',
      label: 'Sample Input',
      maxLength: 42,
      placeholder: 'Sample input'
    }),
    new DynamicInputModel({
      id: 'sampleInpu1',
      label: 'Sample Input1',
      maxLength: 42,
      placeholder: 'Sample 1'
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
   * to get form data and make filter
   * @param event form event to get forms data
   */
  onChange(event) {
    this.getAll(event.group.value);
  }
  /**
   * will run only first time to load all the trips
   */
  getAll(params) {
    this.trip.getAll(params).subscribe(
      (req: RequestData) => {
        console.log(req);
        this.data = req.data;
        this.links = req.links;
        this.meta = req.meta;
      },
      error => this.handleError(error)
    );
  }
  /**
   * used to handle error
   */
  handleError(error): any {
    this.notify.error(error);
  }

  /**
   * when the scroll  t the end
   */
  onScroll() {
    console.log('scrolled!!');
  }

  /**
   * pagination is changed
   */
  pageChange(pagin: Number) {
    console.log('hello');
  }
}
