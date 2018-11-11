import { ILuggage } from './../../interface/iluggage';
import { Component, OnDestroy, OnInit, ElementRef, ViewChild } from '@angular/core';
import {
  DynamicDatePickerModel,
  DynamicFormModel,
  DynamicFormService,
  DynamicInputModel,
  DynamicCheckboxModel,
  DynamicSelectModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { SnotifyService } from 'ng-snotify';
import { RequestData } from '../../models/request-data';
import { Subscription } from 'rxjs';
import { LuggageService } from 'src/app/service/luggage.service';

@Component({
  selector: 'app-luggage',
  templateUrl: './luggages.component.html',
  styleUrls: ['./luggages.component.css']
})
export class LuggagesComponent implements OnInit, OnDestroy {
  data: Array<ILuggage>;
  links: any;
  meta: any;
  filter: any = {};
  /**
   * used to define searchform
   */
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
    new DynamicSelectModel({
      id: 'mass',
      label: 'Mass',
      options: [
          {
              label: '0 - 1',
              value: '0,1'
          },
          {
              label: '1 - 5',
              value: '1,5'
          },
          {
              label: '5 - 10',
              value: '5,10'
          },
          {
              label: '10 - 15',
              value: '10,15'
          },
          {
              label: '15-20',
              value: '10,20'
          },
          {
            label: '20-More',
            value: '20,1000'
          }
      ],
  }),
    new DynamicCheckboxModel({
      id: 'comertial',
      label: 'Comertial',
    }),
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  private valchange: Subscription;
  @ViewChild('myinfiniteScroll') myinfiniteScroll: ElementRef;
  constructor(
    private luggages: LuggageService,
    private formService: DynamicFormService,
    private notify: SnotifyService
  ) { }

  ngOnInit() {
    this.getAll({});
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(({
      start_dt,
      end_dt,
      from_formatted_address,
      to_formatted_address,
      comertial,
      mass
    }) => {
      this.filter.end_dt = end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`;
      this.filter.start_dt = start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`;
      this.filter.from_formatted_address = from_formatted_address;
      this.filter.to_formatted_address = to_formatted_address;
      this.filter.comertial = comertial;
      this.filter.mass = mass;
    });
  }
  /**
   * Finds luggagess component with given parameters
   */
  find() {
    this.getAll(this.filter);
  }
  /**
   * Gets all a function to make request with pagin and filtering
   * @param params -
   */
  getAll(params) {
    this.luggages.getAll(params).subscribe(
      (req: RequestData) => {
        this.data = req.data;
        this.links = req.links;
        this.meta = req.meta;
      },
      error => this.notify.error(error)
    );
  }
  /**
   * Pages change pagination onchange method
   * @param page -
   */
  pageChange(page: Number) {
    this.myinfiniteScroll.nativeElement.scrollTop = 0;
    this.getAll({ page, ...this.filter });
  }
  /**
   * on destroy will work when the compnent leave the dom
   */
  ngOnDestroy(): void {
    this.valchange.unsubscribe();
  }
}
