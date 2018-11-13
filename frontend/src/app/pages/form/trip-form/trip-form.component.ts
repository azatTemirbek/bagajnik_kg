import { Component, OnInit } from '@angular/core';
import { DynamicFormModel, DynamicInputModel, DynamicDatePickerModel, DynamicFormService } from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { Subscription } from 'rxjs';
import { TripService } from 'src/app/service/trip.service';
import { SnotifyService } from 'ng-snotify';
import {RequestData} from "../../../models/request-data";
import {ITrip} from "../../../interface/itrip";

@Component({
  selector: 'app-trip-form',
  templateUrl: './trip-form.component.html',
  styleUrls: ['./trip-form.component.css']
})
export class TripFormComponent implements OnInit {
    data: Array<ITrip>;
    links: any;
    meta: any;
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
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(({ start_dt, end_dt, from_formatted_address, to_formatted_address }) => {
    });
  }
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

}
