import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  user = new BehaviorSubject({});
  basePort = 8000;
  baseApi = `http://localhost:${this.basePort}`;

  constructor(private http: HttpClient) { }
  /**
   * afunction to login
   * @param form password and user data
   */
  login(form) {
    return this.http.post(`${this.baseApi}/api/login`, form).subscribe(
      data => {
        console.log(data);
        this.user.next(data);
        return data;
      },
      // service to show error
      err => {
        console.log(err);
        return err;
      }
    );
  }
}
