import { Component, OnInit, OnDestroy } from '@angular/core';
import { OfferService } from 'src/app/service/offer.service';
import { SnotifyService } from 'ng-snotify';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from 'src/app/service/auth/auth.service';
import { Subscription, BehaviorSubject } from 'rxjs';
import { Location } from '@angular/common';

@Component({
  selector: 'app-offer-result',
  templateUrl: './OfferResult.component.html',
  styleUrls: ['./OfferResult.component.css']
})
export class OfferResultComponent implements OnInit, OnDestroy {
  offerId: any;
  sub: Subscription;
  offer: BehaviorSubject <any> = new BehaviorSubject({});
  constructor(
    private offerService: OfferService,
    private notify: SnotifyService,
    private router: Router,
    private route: ActivatedRoute,
    private auth: AuthService,
    private location: Location
  ) { }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.offerId = +params.id;
      this.offerService.read(this.offerId)
        .subscribe(data => {
          console.log(data);
          this.offer.next(data);
        });

    });
  }
  ngOnDestroy(): void {
    this.sub.unsubscribe();
  }
  /**
   * go to back history back()
   * @param bool -not used
   */
  accept(bool: Boolean) {
    this.location.back();
  }
}
