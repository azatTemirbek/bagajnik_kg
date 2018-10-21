import { AuthService } from './../../service/auth.service';
import { Router } from '@angular/router';
import { TokenService } from './../../service/token.service';
import { JarvisService } from './../../service/jarvis.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public form = {
    email: null,
    password: null
  };
  public error = null;

  constructor(
    private auth: JarvisService,
    private Token: TokenService,
    private Auth: AuthService,
    private router: Router,
    ) { }
  /**
   * data => this.auth.user.next(data),
   */
  onSubmit() {
    this.auth.login(this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }

  handleResponse(data) {
    this.Token.handle(data.access_token);
    this.Auth.loggedIn.next(true);
    this.router.navigateByUrl('/profile');
  }

  handleError(error) {
    this.error = error.error.error;
  }
  ngOnInit() {
  }

}
