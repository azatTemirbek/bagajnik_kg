import {Component, OnDestroy, OnInit} from '@angular/core';
import {
    DynamicCheckboxModel,
    DynamicDatePickerModel,
    DynamicFormModel,
    DynamicFormService,
    DynamicInputModel,
    DynamicSelectModel
} from "@ng-dynamic-forms/core";
import {FormGroup} from "@angular/forms";
import { Subscription} from 'rxjs';
import {SnotifyService} from "ng-snotify";
import {LuggageService} from "../../../service/luggage.service";
import {ActivatedRoute, Router} from "@angular/router";
import { ILuggage } from 'src/app/interface/iluggage';
import {dateParse} from "../../../helpers/util";

@Component({
  selector: 'app-luggage-form',
  templateUrl: './luggage-form.component.html',
  styleUrls: ['./luggage-form.component.css']
})
export class LuggageFormComponent implements OnInit, OnDestroy {
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
            label: 'Номер получателя:',
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
            label: 'Доп. номер получателя:',
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
            placeholder: 'x кг',
            validators: {
                required: null
            },
            errorMessages: {
                required: '{{ label }} необходимо.'
            }
        }),
        new DynamicCheckboxModel({
            id: 'comertial',
            label: 'comertial:',
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

        })
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
    };
    id: Number;
    sub: Subscription;
    valchange: Subscription;
    constructor(
        private formService: DynamicFormService,
        private notifyService: SnotifyService,
        private luggageService: LuggageService,
        private route: ActivatedRoute,
        private router: Router,
    ) { }
    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.id = +params.id;
            if (+params.id > 0) {
                this.luggageService.read(+params.id)
                    .subscribe(({end_dt, start_dt, from_formatted_address, to_formatted_address, takerName, takerPhone1, takerPhone2, mass, comertial, value}: ILuggage) => {
                    this.formGroup.setValue({
                        end_dt: dateParse(end_dt),
                        start_dt: dateParse(start_dt),
                        from_formatted_address,
                        to_formatted_address,
                        takerName, takerPhone1,
                        takerPhone2,
                        mass,
                        comertial,
                        value
                    });
                });
            }
        });
        this.formGroup = this.formService.createFormGroup(this.formModel);
        this.valchange = this.formGroup.valueChanges.subscribe(
            ({ start_dt, end_dt, from_formatted_address, to_formatted_address, takerName, takerPhone1, takerPhone2, mass, comertial, value }) => {
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
                    value
                };
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
        } else {
            this.notifyService.success('Успешно создан!');
        }
        this.router.navigateByUrl('/luggages');
    }
    /**
     * a function used to notify
     * @param error validtion text from the back
     */
    handleError({ error }) {
        for (const key in error.errors) {
            if (error.errors.hasOwnProperty(key)) {
                this.notifyService.error(error.errors[key][0]);
            }
        }
    }
    ngOnDestroy(): void {
        this.valchange.unsubscribe();
        this.sub.unsubscribe();
    }
}