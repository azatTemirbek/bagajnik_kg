import { Configure } from './configure';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class JarvisService {
  user = new BehaviorSubject({});
  private baseUrl = `${Configure.baseUrl}:${Configure.basePort}/api`;

  constructor(private http: HttpClient) { }
  signup(data) {
    return this.http.post(`${this.baseUrl}/signup`, data);
  }
  login(data) {
    return this.http.post(`${this.baseUrl}/login`, data);
  }
  sendPasswordResetLink(data) {
    return this.http.post(`${this.baseUrl}/sendPasswordResetLink`, data);
  }
  changePassword(data) {
    return this.http.post(`${this.baseUrl}/resetPassword`, data);
  }
}
