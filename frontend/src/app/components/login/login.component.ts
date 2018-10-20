import { AuthService } from './../../service/auth.service';
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

  constructor(private auth: AuthService) { }
  onSubmit() {
    return this.auth.login(this.form);
  }

  ngOnInit() {
  }

}
