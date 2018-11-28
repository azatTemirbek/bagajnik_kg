import { Injectable } from '@angular/core';
import {
  HttpInterceptor,
  HttpRequest,
  HttpHandler,
  HttpEvent
} from '@angular/common/http';
import { TokenService } from './auth/token.service';
import { Observable } from 'rxjs';
import { AuthService } from './auth/auth.service';

@Injectable({
  providedIn: 'root'
})
export class CustomHttpInterceptor implements HttpInterceptor {
  constructor(private token: TokenService, private auth: AuthService) { }
  /**
   * intercept
   * @param request request
   * @param next -
   */
  intercept(
    request: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {
    // add authorization header with jwt token if available;
    if (this.token.isValid()) {
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${this.token.get()}`
        }
      });
    } else {
      this.auth.logout();
    }
    return next.handle(request);
  }
}
