import { JarvisService } from '../../service/jarvis.service';
import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/service/token.service';
import { SnotifyService } from 'ng-snotify';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  public form = {
    email: null,
    name: null,
    surname: null,
    phone: null,
    password: null,
    password_confirmation: null
  };
  public error = {
    email: null,
    password: null,
    name: null,
    surname: null,
    phone: null
  };

  constructor(
    private Jarwis: JarvisService,
    private Token: TokenService,
    private router: Router,
    private notify: SnotifyService
  ) { }

  onSubmit() {
    this.Jarwis.signup(this.form).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }
  handleResponse(data) {
    this.Token.handle(data.access_token);
    this.router.navigateByUrl('/profile');
  }
  handleError(error) {
    this.notify.error(error.error.error);
    this.error = error.error.errors;
  }

  ngOnInit() { }
}
