import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class LogicService {
  luggage: BehaviorSubject<any> = new BehaviorSubject(null);
  trip: BehaviorSubject<any> = new BehaviorSubject(null);
  constructor(
    private route: Router
  ) { }
  navigate() {
    if (!this.luggage.getValue()) {
      // todo navigate to trip form
      this.route.navigate(['/luggageform/-1']);
    } else if (!this.trip.getValue()) {
      // todo navigate to luggage form
      this.route.navigate(['/tripform/-1']);
    } else {
      this.route.navigate([`/offerview/${this.trip.getValue().id}/${this.luggage.getValue().id}`]);
    }
  }
  clear() {
    this.luggage.next(null);
    this.trip.next(null);
  }
}
