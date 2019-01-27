import { Component, OnInit } from '@angular/core';
import { OfferService } from 'src/app/service/offer.service';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.css']
})
export class HomePageComponent implements OnInit {
  showSender = '';
  commentsR: any = [];
  constructor(
    private offerService: OfferService
  ) { }

  ngOnInit() {
    this.offerService.getItemByLimit()
      .subscribe(({ data }: any) => {
        console.log(data)
        this.commentsR = data;
      });
  }

}
