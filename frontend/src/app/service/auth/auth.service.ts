import { TokenService } from 'src/app/service/auth/token.service';
import { BehaviorSubject } from 'rxjs';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Configure } from '../configure';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  api = Configure.api();
  loggedIn: BehaviorSubject<boolean> = new BehaviorSubject(this.Token.loggedIn());

  me: BehaviorSubject<any> = new BehaviorSubject({});
  constructor(
    private Token: TokenService,
    private http: HttpClient,
  ) {
    if (this.loggedIn.getValue()) {
      this.me.next(this.getLS());
    }
  }
  update(data) {
    return this.http.patch(`${this.api}/user/${data.id}`, data);
  }
  setMe(userdata) {
    this.setLS(userdata);
    this.me.next(userdata);
  }
  removeMe() {
    this.remove();
  }
  private getLS() {
    const retrievedObject = localStorage.getItem('userdata');
    return JSON.parse(retrievedObject);
  }
  private setLS(userdata) {
    const suserdata = JSON.stringify(userdata);
    localStorage.setItem('userdata', suserdata);
  }
  private remove() {
    localStorage.removeItem('userdata');
  }
}
