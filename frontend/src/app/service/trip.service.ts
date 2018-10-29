import { Trip } from './../models/trip';
import { AuthService } from './auth.service';
import { Configure } from './configure';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class TripService {
  api = Configure.api();

  constructor(
    private http: HttpClient,
    // private auth: AuthService
  ) { }
  /**
   * will return all the trips with pagination
   */
  getAll(params): any {
    return this.http.get(`${this.api}/trips`, {params});
  }
  /**
   * will get spesific trip
   * @param id tripId
   */
  read(id: Number) {
    return this.http.get(`${this.api}/trip/${id}`);
  }
  /**
   * will create trip
   * @param data trip data
   */
  create(data: Trip) {
    return this.http.post(`${this.api}/trips`, data);
  }
  /**
   * to update trip
   * @param data trip data
   */
  update(data: Trip) {
    return this.http.post(`${this.api}/trip/${data.id}`, data);
  }
  /**
   * to delete offfer
   * @param id id of the delete trip
   */
  delete(id: Number) {
    return this.http.delete(`${this.api}/trip/${id}`);
  }
  /**
   * http://localhost:8000/api/trips?page=2
   * @param url gets data with page
   */
  getWith(url) {
    return this.http.get(url);
  }

}
