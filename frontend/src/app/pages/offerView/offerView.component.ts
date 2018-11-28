import { Component, OnInit } from '@angular/core';
import { OfferService } from 'src/app/service/offer.service';
import { SnotifyService } from 'ng-snotify';
import { ActivatedRoute, Router } from '@angular/router';
import { Subscription, BehaviorSubject } from 'rxjs';
import { TripService } from 'src/app/service/trip.service';
import { LuggageService } from 'src/app/service/luggage.service';
import { AuthService } from 'src/app/service/auth/auth.service';
import { Location } from '@angular/common';
import { LogicService } from 'src/app/service/logic.service';

@Component({
  selector: 'app-offerview',
  templateUrl: './offerView.component.html',
  styleUrls: ['./offerView.component.css']
})
export class OfferViewComponent implements OnInit {
  sub: Subscription;
  id: number;
  luggage: BehaviorSubject<any> = new BehaviorSubject({});
  trip: BehaviorSubject<any> = new BehaviorSubject({});
  luggageId: number;
  tripId: number;

  constructor(
    private offerService: OfferService,
    private tripService: TripService,
    private luggageService: LuggageService,
    private notify: SnotifyService,
    private route: ActivatedRoute,
    private router: Router,
    private auth: AuthService,
    private location: Location,
    private logic: LogicService
  ) { }

  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
      this.tripId = +params.tripId;
      this.luggageId = +params.luggageId;
      if (this.luggageId > 0) {
        this.getLuggageData(this.luggageId);
      }
      if (this.tripId > 0) {
        this.getTripData(this.tripId);
      }
      if (this.luggageId < 0 || this.tripId < 0) {
        this.notify.error('url недействителен');
        this.router.navigateByUrl('/404');
      }
    });
  }
  getLuggageData(id) {
    this.luggageService.read(id)
      .subscribe(
        data => this.luggage.next(data),
        error => this.handleError(error)
      );
  }
  getTripData(id) {
    this.tripService.read(id)
      .subscribe(
        data => this.trip.next(data),
        error => this.handleError(error)
      );
  }
  handleError({ message }) {
    this.notify.error(message);
  }
  /**
   * used to tend patch to offer
   * @param bool accpt or not
   */
  sendTo(bool: Boolean) {
    if (bool) {
      if (!this.auth.loggedIn.getValue()) {
        this.router.navigate(['/login']);
      }
      this.offerService.create({
        req_user_id: this.auth.me.getValue().id,
        res_user_id: this.luggage.getValue().owner_id,
        luggage_id: this.luggageId,
        trip_id: this.tripId,
        agree: false,
        status: 'requested',
      })
        .subscribe(data => {
          this.logic.clear();
          this.router.navigate(['/home']);
          this.notify.success('success');
        });
    } else {
      this.location.back();
    }
  }
}
