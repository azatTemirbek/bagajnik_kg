import { Component, OnInit, OnDestroy } from '@angular/core';
import {
  DynamicFormModel,
  DynamicInputModel,
  DynamicDatePickerModel,
  DynamicFormService
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { Subscription, BehaviorSubject } from 'rxjs';
import { SnotifyService } from 'ng-snotify';
import { TripService } from 'src/app/service/trip.service';
import { ActivatedRoute, Router } from '@angular/router';
import { ITrip } from 'src/app/interface/itrip';
import { dateParse } from 'src/app/helpers/util';

@Component({
  selector: 'app-trip-form',
  templateUrl: './trip-form.component.html',
  styleUrls: ['./trip-form.component.css']
})
export class TripFormComponent implements OnInit, OnDestroy {
  formModel: DynamicFormModel = [
    // new DynamicInputModel({
    //   id: 'id',
    //   hidden: true
    // }),
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'Место Отправки',
      maxLength: 400,
      placeholder: 'Анкара'
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'Место Достаяки',
      maxLength: 400,
      placeholder: 'Бишкек'
    }),
    new DynamicDatePickerModel({
      id: 'start_dt',
      label: 'Начальная Дата',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#',
    }),
    new DynamicDatePickerModel({
      id: 'end_dt',
      label: 'Дата Окончание',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#'
    }),
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  private valchange: Subscription;
  formData: {
    end_dt: string;
    start_dt: string;
    from_formatted_address: any;
    to_formatted_address: any;
  };
  sub: Subscription;
  tripData: BehaviorSubject<any> = new BehaviorSubject({});
  constructor(
    private formService: DynamicFormService,
    private notify: SnotifyService,
    private tripService: TripService,
    private route: ActivatedRoute,
    private router: Router,
  ) { }
  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.tripService.read(+params.id).subscribe(({ end_dt, start_dt, from_formatted_address, to_formatted_address}: ITrip) => {
        this.formGroup.setValue({
          end_dt: dateParse(end_dt),
          start_dt: dateParse(start_dt),
          from_formatted_address,
          to_formatted_address
        });
      });
    });
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(
      ({ start_dt, end_dt, from_formatted_address, to_formatted_address }) => {
        this.formData = {
          end_dt: end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`,
          start_dt: start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`,
          from_formatted_address,
          to_formatted_address
        };
      }
    );
  }
  /**
   * form submit and get data from the backend
   */
  submitForm() {
    // todo: error/success notify
    // todo: track id and deside weather update or create
    this.tripService.create(this.formData).subscribe(
      s => console.log(s),
      e => console.log(e),
    );
  }
  ngOnDestroy(): void {
    this.valchange.unsubscribe();
    this.sub.unsubscribe();
  }
}
