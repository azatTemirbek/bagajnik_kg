import { Component, OnDestroy, OnInit, NgZone, AfterViewInit } from '@angular/core';
import {
  DynamicCheckboxModel,
  DynamicDatePickerModel,
  DynamicFormModel,
  DynamicFormService,
  DynamicInputModel,
  DynamicSelectModel,
  DynamicFormLayout,
  DynamicTextAreaModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { Subscription } from 'rxjs';
import { SnotifyService } from 'ng-snotify';
import { LuggageService } from '../../../service/luggage.service';
import { ActivatedRoute, Router } from '@angular/router';
import { ILuggage } from 'src/app/interface/iluggage';
import { dateParse } from '../../../helpers/util';
import { MY_FORM_LAYOUT } from './LUGGAGE_LAYOUT';
import { MapsAPILoader } from '@agm/core';
import { LogicService } from 'src/app/service/logic.service';
import { AuthService } from 'src/app/service/auth/auth.service';
import { Location } from '@angular/common';
declare var google;

@Component({
  selector: 'app-luggage-form',
  templateUrl: './luggage-form.component.html',
  styleUrls: ['./luggage-form.component.css']
})
export class LuggageFormComponent implements OnInit, OnDestroy, AfterViewInit {
  formLayout: DynamicFormLayout = MY_FORM_LAYOUT;
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'Место Отправки',
      maxLength: 400,
      placeholder: 'Анкара',
      spellCheck: false,
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
    new DynamicInputModel({
      id: 'price',
      label: 'Цена',
      maxLength: 400,
      placeholder: '20 com',
      inputType: 'number',
      step: 0.1,
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
    new DynamicInputModel({
      id: 'takerName',
      label: 'ФИО получателя:',
      placeholder: 'ФИО',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicInputModel({
      id: 'takerPhone1',
      label: 'Whatsapp Номер получателя:',
      placeholder: '+xxx xxx xxx xxx',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicInputModel({
      id: 'takerPhone2',
      label: 'Доп. Whatsapp номер получателя:',
      placeholder: '+xxx xxx xxx xxx',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicInputModel({
      id: 'mass',
      label: 'Вес:',
      placeholder: 'кг',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicSelectModel({
      id: 'value',
      label: 'Ценность',
      options: [
        {
          label: 'Ценный',
          value: 'Ценный'
        },
        {
          label: 'Не ценный',
          value: 'Не ценный'
        }
      ],
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }

    }),
    new DynamicCheckboxModel({
      id: 'comertial',
      label: 'Коммерческий:',
      validators: {
        required: null
      },
      errorMessages: {
        required: '{{ label }} необходимо.'
      }
    }),
    new DynamicTextAreaModel({
      id: 'dsc',
      label: 'Описание',
      maxLength: 400,
      placeholder: '',
      spellCheck: true
    }),
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  formData: {
    end_dt: string;
    start_dt: string;
    from_formatted_address: any;
    to_formatted_address: any;
    takerName: String;
    takerPhone1: String;
    takerPhone2: String;
    mass: any;
    comertial: boolean;
    value: String;
    price: String;
    dsc: String
  };
  id: Number;
  sub: Subscription;
  valchange: Subscription;
  ffa: any;
  tfa: any;
  constructor(
    private formService: DynamicFormService,
    private notifyService: SnotifyService,
    private luggageService: LuggageService,
    private route: ActivatedRoute,
    private router: Router,
    private mapsAPILoader: MapsAPILoader,
    private logic: LogicService,
    public auth: AuthService,
    private _location: Location
  ) { }
  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.id = +params.id;
      if (+params.id > 0) {
        this.luggageService.read(+params.id)
          .subscribe(({
            end_dt,
            start_dt,
            from_formatted_address,
            to_formatted_address,
            takerName,
            takerPhone1,
            takerPhone2,
            mass,
            comertial,
            value,
            price,
            dsc
          }: ILuggage) => {
            this.formGroup.setValue({
              end_dt: dateParse(end_dt),
              start_dt: dateParse(start_dt),
              from_formatted_address,
              to_formatted_address,
              takerName, takerPhone1,
              takerPhone2,
              mass,
              comertial,
              value,
              price: price,
              dsc,
            });
          });
      }
    });
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges
      .subscribe(({
        start_dt,
        end_dt,
        from_formatted_address,
        to_formatted_address,
        takerName,
        takerPhone1,
        takerPhone2,
        mass,
        comertial,
        value,
        price,
        dsc
      }) => {
        this.formData = {
          end_dt: end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`,
          start_dt: start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`,
          from_formatted_address,
          to_formatted_address,
          takerName,
          takerPhone1,
          takerPhone2,
          mass,
          comertial,
          value,
          price,
          dsc,
        };
      });
  }
  ngAfterViewInit(): void {
    this.mapsAPILoader.load().then(
      () => {
        if (!this.ffa && !this.tfa) {
          this.ffa = new google.maps.places.Autocomplete(document.getElementById('from_formatted_address'), {
            types: ['(cities)']
          });
          this.tfa = new google.maps.places.Autocomplete(document.getElementById('to_formatted_address'), {
            types: ['(cities)']
          });

          google.maps.event.addListener(this.ffa, 'place_changed', () => {
            this.formGroup.setValue({
              ...this.formGroup.value,
              from_formatted_address: this.ffa.getPlace().formatted_address
            });
          });
          google.maps.event.addListener(this.tfa, 'place_changed', () => {
            this.formGroup.setValue({
              ...this.formGroup.value,
              to_formatted_address: this.tfa.getPlace().formatted_address
            });
          });
        }
      }
    );
  }
  /**
   * form submit and get data from the backend
   */
  submitForm() {
    if (this.id === -1) {
      this.luggageService.create(this.formData)
        .subscribe(
          success => this.handleSuccess(success),
          error => this.handleError(error)
        );
    } else {
      this.luggageService.update({
        ...this.formData,
        id: this.id
      }).subscribe(
        success => this.handleSuccess(success),
        error => this.handleError(error)
      );
    }
  }
  /**
   * a function to handle the responce
   * @param data success data
   */
  handleSuccess(data) {
    if (this.id > 0) {
      this.notifyService.success('Успешно обновлено!');
      this._location.back();
    } else {
      this.notifyService.success('Успешно создан!');
      this.logic.luggage.next(data.data);
      this.logic.navigate();
    }
  }
  /**
   * a function used to notify
   * @param error validtion text from the back
   */
  handleError({ errors }) {
    for (const key in errors) {
      if (errors.hasOwnProperty(key)) {
        this.notifyService.error(errors[key][0]);
      }
    }
  }
  ngOnDestroy(): void {
    this.valchange.unsubscribe();
    this.sub.unsubscribe();
  }
}
