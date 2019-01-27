import { ILuggage } from './../../interface/iluggage';
import { Component, OnDestroy, OnInit, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
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
import { Options, LabelType } from 'ng5-slider';
import { MapsAPILoader } from '@agm/core';
import { AuthService } from 'src/app/service/auth/auth.service';
import { LogicService } from 'src/app/service/logic.service';
import { ActivatedRoute } from '@angular/router';
declare var google;
import {NgbModal, ModalDismissReasons, NgbRatingConfig} from '@ng-bootstrap/ng-bootstrap';
import { parseDtaeFromUrll } from '../trips/trips.component';

@Component({
  selector: 'app-luggage',
  templateUrl: './luggages.component.html',
  styleUrls: ['./luggages.component.css']
})
export class LuggagesComponent implements OnInit, OnDestroy, AfterViewInit {
  /** range price */
  minValue: Number = 0;
  maxValue: Number = 1000;
  options: Options = {
    floor: 0,
    ceil: 1000,
    translate: (value: Number, label: LabelType): string => {
      switch (label) {
        case LabelType.Low:
          return `${value} сом`;
        case LabelType.High:
          return `${value} сом`;
        default:
          return value + 'сом';
      }
    }
  };
  /** range price end */
  /** list of luggages */
  data: Array<ILuggage>;
  links: any;
  meta: any;
  filter: any = {};
  /**
   * used to define searchform
   */
  formModel: DynamicFormModel =  [];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  private valchange: Subscription;
  @ViewChild('myinfiniteScroll') myinfiniteScroll: ElementRef;
  ffa: any;
  tfa: any;
  sub: Subscription;
  closeResult: string;

  constructor(
    private luggage: LuggageService,
    private formService: DynamicFormService,
    private notify: SnotifyService,
    private mapsAPILoader: MapsAPILoader,
    private auth: AuthService,
    public logic: LogicService,
    private route: ActivatedRoute,
    private modalService: NgbModal,
    config: NgbRatingConfig
  ) {
    config.max = 5;
    config.readonly = true;
  }

  openModal(content, item) {
    console.log(item)
    this.modalService.open(content, {size: 'lg', ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }

   private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return  `with: ${reason}`;
    }
  }
  ngOnInit() {
    this.sub = this.route
      .queryParams
      .subscribe(params => {
        this.filter = {...this.filter, ...params};
        this.getAll(this.filter);
      });
    this.formModel = [
      new DynamicInputModel({
        id: 'from_formatted_address',
        label: 'Место Отправки',
        value: this.filter.from_formatted_address,
        maxLength: 42,
        placeholder: 'Анкара'
      }),
      new DynamicInputModel({
        id: 'to_formatted_address',
        label: 'Место Доставки',
        value: this.filter.to_formatted_address,
        maxLength: 42,
        placeholder: 'Бишкек'
      }),
      new DynamicDatePickerModel({
        id: 'start_dt',
        label: 'Начальная Дата',
        value: parseDtaeFromUrll(this.filter.start_dt),
        placeholder: 'ГГГГ-ММ-ДД',
        toggleLabel: '#',
      }),
      new DynamicDatePickerModel({
        id: 'end_dt',
        label: 'Дата Окончание',
        value: parseDtaeFromUrll(this.filter.end_dt),
        placeholder: 'ГГГГ-ММ-ДД',
        toggleLabel: '#'
      }),
      new DynamicSelectModel({
        id: 'mass',
        label: 'Вес',
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
      // new DynamicSelectModel({
      //   id: 'value',
      //   label: 'Ценность',
      //   options: [
      //     {
      //       label: 'Ценный',
      //       value: 'Ценный'
      //     },
      //     {
      //       label: 'Не ценный',
      //       value: 'Не ценный'
      //     }
      //   ],
      // }),
      new DynamicCheckboxModel({
        id: 'comertial',
        label: 'Коммерческий',
      }),
    ];
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(({
      start_dt,
      end_dt,
      from_formatted_address,
      to_formatted_address,
      comertial,
      mass,
      // value
    }) => {
      this.filter.end_dt = end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`;
      this.filter.start_dt = start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`;
      this.filter.from_formatted_address = from_formatted_address;
      this.filter.to_formatted_address = to_formatted_address;
      this.filter.comertial = comertial;
      this.filter.mass = mass;
      // this.filter.value = value;
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
   * Finds luggagess component with given parameters
   */
  find() {
    this.getAll({
      ...this.filter,
      price: this.minValue + ',' + this.maxValue
    });
  }
  /**
   * used to reset the form
   */
  resetAndFind() {
    this.formGroup.reset();
    this.minValue = 0;
    this.maxValue = 1000;
    this.find();
  }
  /**
   * Gets all a function to make request with pagin and filtering
   * @param params -
   */
  getAll(params) {
    this.luggage.getAll(params).subscribe(
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
    this.sub.unsubscribe();
  }
}
