import { Component, OnDestroy, OnInit, } from '@angular/core';
import {
    DynamicFormLayout,
    DynamicFormModel,
    DynamicFormService,
    DynamicInputModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { SnotifyService } from 'ng-snotify';
import { Subscription } from 'rxjs';
import {IUser} from "../../interface/iuser";
import {AuthService} from "../../service/auth/auth.service";
import {MY_FORM_LAYOUT} from "../form/trip-form/TRIP_LAYOUT";
import {dateParse} from "../../helpers/util";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit, OnDestroy {
    formLayout: DynamicFormLayout = MY_FORM_LAYOUT;
    formModel: DynamicFormModel = [
        new DynamicInputModel({
            id: 'name',
            label: 'Name',
            maxLength: 42,
            placeholder: 'Your name: Azat'
        }),
        new DynamicInputModel({
            id: 'surname',
            label: 'Surname',
            maxLength: 42,
            placeholder: 'Your surname: Temirbek'
        }),
        new DynamicInputModel({
            id: 'phone',
            label: 'Phone',
            maxLength: 42,
            placeholder: 'Your phone number: +xxx xxx xx xx xx'
        }),
        new DynamicInputModel({
            id: 'email',
            label: 'Email',
            maxLength: 42,
            placeholder: 'Your email: example@for.you'
        }),
        new DynamicInputModel({
            id: 'password',
            label: 'Password',
            maxLength: 42,
            placeholder: 'Password:**********'
        }),
    ];
    /**
     * used to store formGroup
     */
    formGroup: FormGroup;
    formData: {
        name: string;
        surname: string;
        email: any;
        phone: number;
    };
    id: Number;
    sub: Subscription;
    valchange: Subscription;
    constructor(
        private AuthService: AuthService,
        private formService: DynamicFormService,
        private notifyService: SnotifyService,
        private route: ActivatedRoute,
        private router: Router,
    ) { }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            this.id = +params.id;
            if (+params.id > 0) {
                this.AuthService.read(+params.id)
                    .subscribe(({ name, surname, email, phone}: IUser) => {
                        this.formGroup.setValue({
                            name: dateParse(name),
                            surname: dateParse(surname),
                            email,
                            phone
                        });
                    });
            }
        });
        this.formGroup = this.formService.createFormGroup(this.formModel);
        this.valchange = this.formGroup.valueChanges.subscribe(
            ({ name, surname, email, phone }) => {
                this.formData = {
                    name,
                    surname,
                    email,
                    phone
                };
            }
        );
    }
    /**
     * form submit and get data from the backend
     */
    submitForm() {
        this.AuthService.update({
           ...this.formData,
           id: this.id
           }).subscribe(
           success => this.handleSuccess(success),
           error => this.handleError(error)
        );

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
