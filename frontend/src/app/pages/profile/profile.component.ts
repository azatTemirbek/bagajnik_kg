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
import { AuthService } from '../../service/auth/auth.service';
import { MY_FORM_LAYOUT } from '../form/trip-form/TRIP_LAYOUT';
import { ActivatedRoute, Router } from '@angular/router';

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
      placeholder: 'Your email: example@for.you',
      disabled: true
    })
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  formData: {
    name: string;
    surname: string;
    phone: number;
  };
  id: Number;
  sub: Subscription;
  valchange: Subscription;
  constructor(
    private authService: AuthService,
    private formService: DynamicFormService,
    private notifyService: SnotifyService,
    private route: ActivatedRoute,
    private router: Router,
  ) { }

  ngOnInit() {
    if (!this.authService.loggedIn) {
      this.router.navigateByUrl('/login');
      return;
    }
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(
      ({ name, surname, email, phone }) => {
        this.formData = {
          name,
          surname,
          phone
        };
      }
    );
    this.formGroup.setValue({
      name: this.authService.me.getValue().name,
      surname: this.authService.me.getValue().surname,
      email: this.authService.me.getValue().email,
      phone: this.authService.me.getValue().phone,
    });
    this.authService.getUserData()
    // todo:user data is used to display all the related actions and trips with offers and luggages history also
      .subscribe(data => console.log(data));
  }
  /**
   * form submit and get data from the backend
   */
  submitForm() {
    this.authService.update({
      ...this.formData,
      id: this.authService.me.getValue().id
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
    this.notifyService.success('Успешно обновлено!');
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
  }
}
