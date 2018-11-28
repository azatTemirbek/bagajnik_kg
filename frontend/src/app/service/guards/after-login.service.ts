import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { TokenService } from '../auth/token.service';

@Injectable({
  providedIn: 'root'
})
export class AfterLoginService implements CanActivate {

  constructor(
    private Token: TokenService,
    private router: Router,

  ) { }
  /**
   * will return false if does not have token on the front end
   * @param route ActivatedRouteSnapshot
   * @param state RouterStateSnapshot
   */
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> | Promise<boolean> | boolean | any {
    if (this.Token.loggedIn()) {
      return true;
    }
    this.router.navigateByUrl('/login');
    return false;
  }
}
