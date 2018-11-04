import { TokenService } from 'src/app/service/auth/token.service';
import { BehaviorSubject } from 'rxjs';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  loggedIn = new BehaviorSubject < boolean >(this.Token.loggedIn());
  constructor( private Token: TokenService ) { }
}
