import { Component, OnInit, AfterViewInit } from '@angular/core';
import { DynamicFormLayout, DynamicFormModel, DynamicInputModel, DynamicDatePickerModel, DynamicFormService } from '@ng-dynamic-forms/core';
import { FormGroup } from '@angular/forms';
import { MapsAPILoader } from '@agm/core';
declare var google;
declare var document;

@Component({
  selector: 'app-jumbo-child-two',
  templateUrl: './jumboChildTwo.component.html',
  styleUrls: ['./jumboChildTwo.component.css']
})
export class JumboChildTwoComponent implements OnInit, AfterViewInit {
  ffa: any;
  tfa: any;
  formLayout: DynamicFormLayout = {
    from_formatted_address: {
      element: {
        label: 'control-label'
      },
      grid: {
        control: 'col',
        label: 'col'
      }
    },
    to_formatted_address: {
      element: {
        label: 'control-label'
      },
      grid: {
        control: 'col',
        label: 'col'
      }
    },
    start_dt: {
      element: {
        label: 'control-label'
      },
      grid: {
        control: 'col',
        label: 'col'
      }
    },
    end_dt: {
      element: {
        label: 'control-label'
      },
      grid: {
        control: 'col',
        label: 'col'
      }
    }
  };

  formGroup: FormGroup;
  formModel: DynamicFormModel = [
    new DynamicInputModel({
      id: 'from_formatted_address',
      label: 'Место Отправки',
      maxLength: 42,
      placeholder: 'Анкара'
    }),
    new DynamicInputModel({
      id: 'to_formatted_address',
      label: 'Место Доставки',
      maxLength: 42,
      placeholder: 'Бишкек'
    }),
    new DynamicDatePickerModel({
      id: 'start_dt',
      label: 'Начальная Дата',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#'
    }),
    new DynamicDatePickerModel({
      id: 'end_dt',
      label: 'Дата Окончание',
      placeholder: 'ГГГГ-ММ-ДД',
      toggleLabel: '#'
    })
  ];
  valchange: any;
  formData: { end_dt: string; start_dt: string; from_formatted_address: any; to_formatted_address: any; };

  constructor(
    private mapsAPILoader: MapsAPILoader,
    private formService: DynamicFormService
  ) { }

  ngOnInit() {
    this.formGroup = this.formService.createFormGroup(this.formModel);
    this.valchange = this.formGroup.valueChanges
      .subscribe(({
        start_dt,
        end_dt,
        from_formatted_address,
        to_formatted_address,
      }) => {
        this.formData = {
          end_dt: end_dt && `${end_dt.year}-${end_dt.month}-${end_dt.day} 00:00:00`,
          start_dt: start_dt && `${start_dt.year}-${start_dt.month}-${start_dt.day} 00:00:00`,
          from_formatted_address,
          to_formatted_address
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

}
