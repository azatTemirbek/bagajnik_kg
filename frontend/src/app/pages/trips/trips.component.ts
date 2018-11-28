import {
  Component,
  OnDestroy,
  OnInit,
  ElementRef,
  ViewChild,
  AfterViewInit
} from '@angular/core';
import {
  DynamicDatePickerModel,
  DynamicFormModel,
  DynamicFormService,
  DynamicInputModel
} from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { TripService } from '../../service/trip.service';
import { SnotifyService } from 'ng-snotify';
import { RequestData } from '../../models/request-data';
import { ITrip } from '../../interface/itrip';
import { Subscription } from 'rxjs';
import { MapsAPILoader } from '@agm/core';
import { LogicService } from 'src/app/service/logic.service';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from 'src/app/service/auth/auth.service';
declare var google;

@Component({
  selector: 'app-trips',
  templateUrl: './trips.component.html',
  styleUrls: ['./trips.component.css']
})
export class TripsComponent implements OnInit, OnDestroy, AfterViewInit {
  data: Array<ITrip>;
  links: any;
  meta: any;
  filter: any = {};
  @ViewChild('myinfiniteScroll') myinfiniteScroll: ElementRef;
  /**
   * used to define searchform
   */
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'Место Отправки',
      maxLength: 42,
      placeholder: 'Анкара'
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'Место Достаяки',
      maxLength: 42,
      placeholder: 'Бишкек'
    }),
    new DynamicDatePickerModel({
      id: 'start_dt',
      label: 'Дата вылета c:',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#'
    }),
    new DynamicDatePickerModel({
      id: 'end_dt',
      label: 'Дата вылета до:',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#'
    })
  ];
  /**
   * used to store formGroup
   */
  formGroup: FormGroup;
  private valchange: Subscription;
  ffa: any;
  tfa: any;
  sub: any;
  constructor(
    private trip: TripService,
    private formService: DynamicFormService,
    private notify: SnotifyService,
    private mapsAPILoader: MapsAPILoader,
    public logic: LogicService,
    private route: ActivatedRoute,
    private auth: AuthService
  ) {}

  ngOnInit() {
    this.sub = this.route.queryParams.subscribe(params => {
      this.filter.carrier_id = +params['carrier_id'] || null;
      this.getAll({ carrier_id: this.filter.carrier_id });
    });
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges.subscribe(
      ({ start_dt, end_dt, from_formatted_address, to_formatted_address }) => {
        this.filter.end_dt =
          end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`;
        this.filter.start_dt =
          start_dt &&
          `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`;
        this.filter.from_formatted_address = from_formatted_address;
        this.filter.to_formatted_address = to_formatted_address;
      }
    );
  }
  ngAfterViewInit(): void {
    this.mapsAPILoader.load().then(() => {
      if (!this.ffa && !this.tfa) {
        this.ffa = new google.maps.places.Autocomplete(
          document.getElementById('from_formatted_address'),
          {
            types: ['(cities)']
          }
        );
        this.tfa = new google.maps.places.Autocomplete(
          document.getElementById('to_formatted_address'),
          {
            types: ['(cities)']
          }
        );
      }
    });
  }
  /**
   * Finds trips component with given parameters
   */
  find() {
    this.getAll(this.filter);
  }
  /**
   * Gets all a function to make request with pagin and filtering
   * @param params -
   */
  getAll(params) {
    this.trip.getAll(params).subscribe(
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
