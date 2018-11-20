import { Offer } from './../models/offer';
import { AuthService } from './auth/auth.service';
import { Configure } from './configure';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class OfferService {
  api = Configure.api();

  constructor(
    private http: HttpClient,
    private auth: AuthService
  ) { }
  /**
   * will return all the offers with pagination
   */
  getAll(params) {
    return this.http.get(`${this.api}/offers`, { params });
  }
  /**
   * will get spesific offer
   * @param id offerId
   */
  read(id: Number) {
    return this.http.get(`${this.api}/offers/${id}`);
  }
  /**
   * will create offer
   * @param data offer data
   */
  create(data: Offer) {
    return this.http.post(`${this.api}/offers`, data);
  }
  /**
   * to update Offer
   * @param data offer data
   */
  update(data: Offer) {
    return this.http.put(`${this.api}/offers/${+data.id}`, data);
  }
  /**
   * to delete offfer
   * @param id id of the delete Offer
   */
  delete(id: Number) {
    return this.http.delete(`${this.api}/offers/${id}`);
  }
  /**
   * http://localhost:8000/api/trips?page=2
   * @param url gets data with page
   */
  getWith(url) {
    return this.http.get(url);
  }
  /**
   * used to get new offer count request
   */
  getNewOfferCount(): any {
    return this.getAll({
      from_req_user_id: 2,
      status: 'requested'
    });
  }
}
