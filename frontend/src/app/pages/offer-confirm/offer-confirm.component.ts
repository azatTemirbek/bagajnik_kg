import { Component, OnInit } from '@angular/core';
import { Subscription, BehaviorSubject } from 'rxjs';
import { OfferService } from 'src/app/service/offer.service';
import { SnotifyService } from 'ng-snotify';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthService } from 'src/app/service/auth/auth.service';

@Component({
  selector: 'app-offer-confirm',
  templateUrl: './offer-confirm.component.html',
  styleUrls: ['./offer-confirm.component.css']
})
export class OfferConfirmComponent implements OnInit {
  sub: Subscription;
  id: number;
  offer: BehaviorSubject<any> = new BehaviorSubject({});
  link = 'whatsapp://wa.me/';

  constructor(
    private offerService: OfferService,
    private notify: SnotifyService,
    private route: ActivatedRoute,
    private router: Router,
    private auth: AuthService
  ) { }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.id = +params.id;
      if (+params.id > 0) {
        this.offerService.read(+params.id)
          .subscribe((data: any) => {
            this.offer.next(data);
            this.link = this.link +
            this.auth.me.getValue().phone +
            encodeURI(`Я готов взять ваш багаж с ${
              data.relationships.luggage.from_formatted_address
            } до ${
              data.relationships.luggage.to_formatted_address
            } по ${
              data.relationships.luggage.start_dt - data.relationships.luggage.end_dt
            }`);
          });
      }
    });
  }
  /**
   * used to tend patch to offer
   * @param bool accpt or not
   */
  accept(bool: Boolean) {
    this.offerService.accept({
      id: this.id,
      agree: bool,
      status: 'responded'
    })
      .subscribe((data) => {
        if (bool) {
          this.notify.success('Спасибо. Е-соглашение мы отправим вам на почту');
        } else {
          this.notify.info('Соглашение Отменино');
        }
      });
  }
}
