import { RequestData } from './../../models/request-data';
import { TripService } from './../../service/trip.service';
import { Component, OnInit } from '@angular/core';
import { Trip } from 'src/app/models/trip';

@Component({
  selector: 'app-trips',
  templateUrl: './trips.component.html',
  styleUrls: ['./trips.component.css']
})
export class TripsComponent implements OnInit {
  data: any;
  links: any;
  meta: any;
  constructor(
    private trip: TripService
  ) { }

  ngOnInit() {
    this.getAll({name: 'azat'});
  }
  /**
   * will run only first time to load all the trips
  */
  getAll(params) {
    this.trip.getAll(params).subscribe(
      (req: RequestData) => {
        this.data = req.data;
        this.links = req.links;
        this.meta = req.meta;
      },
      error => console.log(error),
    );
  }

}
