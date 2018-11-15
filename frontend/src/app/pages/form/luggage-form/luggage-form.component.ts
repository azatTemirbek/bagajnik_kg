import { Component, OnInit } from '@angular/core';
import {LuggageService} from "../../../service/luggage.service";
import {
    DynamicCheckboxModel,
    DynamicDatePickerModel,
    DynamicFormModel,
    DynamicFormService,
    DynamicInputModel,
    DynamicSelectModel
} from "@ng-dynamic-forms/core";
import {FormGroup} from "@angular/forms";
import {BehaviorSubject, Subscription} from "rxjs";
import {SnotifyService} from "ng-snotify";
import { ILuggage } from 'src/app/interface/iluggage';
import {ActivatedRoute, Router} from "@angular/router";
import {dateParse} from "../../../helpers/util";

@Component({
  selector: 'app-luggage-form',
  templateUrl: './luggage-form.component.html',
  styleUrls: ['./luggage-form.component.css']
})
export class LuggageFormComponent implements OnInit {
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
        new DynamicInputModel({
            id: 'takerName',
            label: 'ФИО получателя:',
            placeholder: 'ФИО',
        }),
        new DynamicInputModel({
            id: 'takerPhone1',
            label: 'Номер получателя:',
            placeholder: '+xxx xxx xxx xxx',
        }),
        new DynamicInputModel({
            id: 'takerPhone2',
            label: 'Доп. номер получателя:',
            placeholder: '+xxx xxx xxx xxx',
        }),
        new DynamicInputModel({
            id: 'mass',
            label: 'Вес:',
            placeholder: 'x кг',
        }),
        new DynamicCheckboxModel({
            id: 'comertial',
            label: 'comertial:',
        }),
        new DynamicSelectModel({
            id: 'value',
            label: 'Ценность',

        })
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
        takerName: String;
        takerPhone1: String;
        takerPhone2: String;
        mass: any;
        comertial: boolean;
        value: String;
    };
    sub: Subscription;
    luggageData: BehaviorSubject<any> = new BehaviorSubject({});
    constructor(
        private formService: DynamicFormService,
        private notify: SnotifyService,
        private luggageService: LuggageService,
        private route: ActivatedRoute,
        private router: Router,
    ) { }
    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.luggageService.read(+params.id).subscribe(({ end_dt, start_dt, from_formatted_address, to_formatted_address}: ILuggage) => {
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
        // todo: error/success notify
        // todo: track id and deside weather update or create
        // @ts-ignore
        this.luggageService.create(this.formData).subscribe(
            s => console.log(s),
            e => console.log(e),
        );
    }
    ngOnDestroy(): void {
        this.valchange.unsubscribe();
        this.sub.unsubscribe();
    }
}
