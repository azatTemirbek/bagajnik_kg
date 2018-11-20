import { TokenService } from 'src/app/service/auth/token.service';
import { Router } from '@angular/router';
import { AuthService } from '../../service/auth/auth.service';
import { Component, OnInit, OnDestroy } from '@angular/core';
import { BehaviorSubject, interval, Subscription } from 'rxjs';
import { OfferService } from 'src/app/service/offer.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit, OnDestroy {
  open: Boolean = false;
  dOpen: Boolean = false;
  unReadedCount: BehaviorSubject<any> = new BehaviorSubject(1);
  unReadedData: BehaviorSubject<any> = new BehaviorSubject([]);
  sub: Subscription;

  constructor(
    public Auth: AuthService,
    private route: Router,
    private Token: TokenService,
    private offerService: OfferService
  ) {
    const source = interval(5000);
    this.sub = source.subscribe((val) => {
      this.offerService.getNewOfferCount().subscribe(({ data, meta }) => {
        this.unReadedCount.next(meta.total);
        if (!this.dOpen) {
          this.unReadedData.next(data);
        }
        console.log(data);
      });
    });
  }

  ngOnInit() { }
  ngOnDestroy() {
    this.sub.unsubscribe();
  }
  /**used to change status of the offer to viewed */
  makeStatusViewed(offer) {
    this.offerService.update({ ...offer, status: 'viewed' })
      .subscribe(data => {
        console.log('asdsadsadsadsadsadsadsdadasdsdsdsadsa');
        console.log(data);
        alert('hello');
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
}
