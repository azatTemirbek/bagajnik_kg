import { TokenService } from 'src/app/service/auth/token.service';
import { BehaviorSubject } from 'rxjs';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  loggedIn: BehaviorSubject<boolean> = new BehaviorSubject(this.Token.loggedIn());
  // todo
  me: BehaviorSubject<any> = new BehaviorSubject({});
  constructor(private Token: TokenService) { }
}
