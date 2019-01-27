import { JarvisService } from '../../../service/auth/jarvis.service';
import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/service/auth/token.service';
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
    password_confirmation: null,
    photo: null
  };
  public error = {
    email: null,
    password: null,
    name: null,
    surname: null,
    phone: null,
    photo: null
  };

  constructor(
    private Jarwis: JarvisService,
    private Token: TokenService,
    private router: Router,
    private notify: SnotifyService
  ) { }

  fileUpload(event) {
    const fileList: FileList = event.target.files;
    if (fileList.length > 0) {
      this.form.photo = fileList[0];
    }
  }

  onSubmit() {
    // tslint:disable-next-line:prefer-const
    let formData: FormData = new FormData();
    formData.append('photo', this.form.photo, this.form.photo.name);
    formData.append('email', this.form.email);
    formData.append('password', this.form.password);
    formData.append('password_confirmation', this.form.password_confirmation);
    formData.append('name', this.form.name);
    formData.append('surname', this.form.surname);
    formData.append('phone', this.form.phone);
    this.Jarwis.signup(formData).subscribe(
      data => this.handleResponse(data),
      error => this.handleError(error)
    );
  }
  handleResponse(data) {
    this.Token.handle(data.access_token);
    this.router.navigateByUrl('/profile');
  }
  handleError({errors, message}) {
    this.notify.error(message);
    this.error = errors;
  }
  ngOnInit() { }
}
