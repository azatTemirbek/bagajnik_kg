import { TokenService } from 'src/app/service/auth/token.service';
import { BehaviorSubject } from 'rxjs';
import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Configure} from "../configure";

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
      ) { }
    read(id: Number) {
        return this.http.get(`${this.api}/user/${id}`);
    }
    update(data) {
        return this.http.post(`${this.api}/user/${data.id}`, data);
    }
}
