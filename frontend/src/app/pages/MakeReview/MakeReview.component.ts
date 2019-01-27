import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { OfferService } from 'src/app/service/offer.service';
import { BehaviorSubject } from 'rxjs';
import { AuthService } from 'src/app/service/auth/auth.service';
import { NgbRatingConfig } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-make-review',
  templateUrl: './MakeReview.component.html',
  styleUrls: ['./MakeReview.component.css']
})
export class MakeReviewComponent implements OnInit {
  offerId: number;
  offer: BehaviorSubject<any> = new BehaviorSubject({});
  form: any = {
    rate_value: 3,
    comment: '',
    from_user_id: '',
    to_user_id: ''
  };
  constructor(
    private route: ActivatedRoute,
    private offerService: OfferService,
    private Auth: AuthService,
    private router: Router,
    config: NgbRatingConfig
  ) {
    config.max = 5;
    this.form.from_user_id = this.Auth.me.getValue().id;
  }

  onFormSubmit() {
    this.offerService.createComment(this.form)
      .subscribe((data: any) => {
        if (data.rate_value = this.form.rate_value) {
          this.router.navigate(['/']);
        }
      });
  }
  textchange(event: any) {
    this.form.comment = event.target.value;
  }
  ngOnInit() {
    this.route.params.subscribe(params => {
      this.offerId = +params.id;
      this.offerService.read(this.offerId)
        .subscribe((data: any) => {
          console.log(data);
          this.offer.next(data);
          this.form.to_user_id = (+data.req_user_id === +this.form.from_user_id) ? data.res_user_id : data.req_user_id;
        });
    });
  }
}
