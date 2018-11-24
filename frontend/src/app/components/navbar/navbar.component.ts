import { TokenService } from 'src/app/service/auth/token.service';
import { Router } from '@angular/router';
import { AuthService } from '../../service/auth/auth.service';
import { Component, OnInit, OnDestroy, HostListener, ElementRef } from '@angular/core';
import { BehaviorSubject, interval, Subscription } from 'rxjs';
import { OfferService } from 'src/app/service/offer.service';
import { Configure } from 'src/app/service/configure';
@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit, OnDestroy {
  /** mobil */
  open: Boolean = false;
  /** open dropdown */
  dOpen: Boolean = false;
  /** unreded count of offer requested and responded */
  unReadedCount: BehaviorSubject<Number> = new BehaviorSubject<Number>(0);
  /** data of the unreaded and responded data */
  unReadedData: BehaviorSubject<any> = new BehaviorSubject([]);
  /** subscribtion of the interval request */
  sub: Subscription;
  constructor(
    public Auth: AuthService,
    private route: Router,
    private Token: TokenService,
    private offerService: OfferService,
    private eRef: ElementRef
  ) { }
  ngOnInit() {
    if (this.Auth.loggedIn.getValue() && !this.sub) {
      this.getOfferCount();
      const source = interval(Configure.requestInterval);
      this.sub = source.subscribe(a => this.getOfferCount());
    }
  }
  ngOnDestroy() {
    if (this.Auth.loggedIn.getValue()) {
      this.sub.unsubscribe();
    }
  }
  /**
   * fets offer count
   */
  getOfferCount() {
    this.offerService.getNewOfferCount().subscribe(({ data, meta }) => {
      this.unReadedCount.next(meta.total);
      if (!this.dOpen) {
        this.unReadedData.next(data);
      }
    });
  }
  navigate(offer) {
    console.log(offer);
    if (offer.status === 'requested') {
      // navigate to confirm
      this.route.navigate(['/offerconfirm', offer.id]);
    } else {
      // navigate to view the
      this.route.navigate(['/offer-result-from-peer', offer.id]);
    }
  }
  /**
   * used to change status of the offer to viewed
   */
  makeStatusViewed(offer, eye) {
    this.offerService.update({ ...offer, status: 'viewed' })
      .subscribe(data => {
        this.unReadedCount.next(+this.unReadedCount.getValue() - 1);
        eye.innerHTML = '<i class="far fa-eye-slash"></i>';
        eye.style.backgroundColor = 'orange';
      });
  }
  /**
   * function to toggle the mobile menu
   */
  toggleOpen() {
    this.open = !this.open;
  }
  toggleD() {
    this.dOpen = !this.dOpen;
  }
  /**
   * auth logout method
   */
  logout() {
    this.Auth.me.next({});
    this.Auth.loggedIn.next(!this.Auth.loggedIn.getValue());
    this.route.navigateByUrl('/login');
    this.Token.remove();
  }
  /**
   * event used when clicked outside of the navigation
   * @param event event used when clicked outside of the navigation
   */
  @HostListener('document:click', ['$event'])
  clickout(event) {
    if (this.Auth.loggedIn.getValue() && !this.sub) {
      this.getOfferCount();
      const source = interval(Configure.requestInterval);
      this.sub = source.subscribe(a => this.getOfferCount());
    }
    // tslint:disable-next-line:no-unused-expression
    if (!this.eRef.nativeElement.contains(event.target)) {
      this.dOpen = false;
    }
  }
}
