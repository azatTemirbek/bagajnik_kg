import { Component, OnInit } from '@angular/core';
import {DynamicDatePickerModel, DynamicFormModel, DynamicInputModel} from "@ng-dynamic-forms/core";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

    // formModel: DynamicFormModel = [
    //     new DynamicInputModel({
    //         id: 'name',
    //         label: 'Name',
    //         maxLength: 42,
    //         placeholder: 'Your name: Azat'
    //     }),
    //     new DynamicInputModel({
    //         id: 'surname',
    //         label: 'Surname',
    //         maxLength: 42,
    //         placeholder: 'Your surname: Temirbek'
    //     }),
    //     new DynamicInputModel({
    //         id: 'phone',
    //         label: 'Phone',
    //         maxLength: 42,
    //         placeholder: 'Your phone number: +xxx xxx xx xx xx'
    //     }),
    //     new DynamicInputModel({
    //         id: 'email',
    //         label: 'Email',
    //         maxLength: 42,
    //         placeholder: 'Your email: example@for.you'
    //     }),
    //     new DynamicInputModel({
    //         id: 'password',
    //         label: 'Password',
    //         maxLength: 42,
    //         placeholder: 'Password:**********'
    //     }),
    // ];

  constructor() { }

  ngOnInit() {
  }

}
