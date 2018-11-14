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
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'Место Отправки',
      maxLength: 400,
      placeholder: 'Анкара',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'Место Достаяки',
      maxLength: 400,
      placeholder: 'Бишкек',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicDatePickerModel({
      id: 'start_dt',
      label: 'Начальная Дата',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicDatePickerModel({
      id: 'end_dt',
      label: 'Дата Окончание',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
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
  id: Number;
  constructor(
    private formService: DynamicFormService,
    private notifyService: SnotifyService,
    private tripService: TripService,
    private route: ActivatedRoute,
    private router: Router,
  ) { }
  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.id = +params.id;
      if (+params.id > 0) {
        this.tripService.read(+params.id).subscribe(({ end_dt, start_dt, from_formatted_address, to_formatted_address, id }: ITrip) => {
          this.formGroup.setValue({
            end_dt: dateParse(end_dt),
            start_dt: dateParse(start_dt),
            from_formatted_address,
            to_formatted_address
          });
        });
      }
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
    if (!this.formGroup.valid) {
      if (this.id === -1) {
        this.tripService.create(this.formData).subscribe(
          success => this.handleSuccess(success),
          error => this.handleError(error)
        );
      } else {
        this.tripService.update({
          ...this.formData,
          id: this.id
        }).subscribe(
          success => this.handleSuccess(success),
          error => this.handleError(error)
        );
      }
    }
  }
  /**
   * a function to handle the responce
   * @param data success data
   */
  handleSuccess(data) {
    console.log(data);
    this.notifyService.success('error');
  }
  /**
   * a function used to notify
   * @param error validtion text from the back
   */
  handleError({ error }) {
    console.log(error.errors);
    this.notifyService.success('error');
  }
  ngOnDestroy(): void {
    this.valchange.unsubscribe();
    this.sub.unsubscribe();
  }
}
