import { JarvisService } from './../../../service/jarvis.service';
import { SnotifyService } from 'ng-snotify';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-responce-reset',
  templateUrl: './responce-reset.component.html',
  styleUrls: ['./responce-reset.component.css']
})
export class ResponceResetComponent implements OnInit {
  public error = [];
  public form = {
    email: null,
    password: null,
    password_confirmation: null,
    restToken: null
  };

  constructor(
    private route: ActivatedRoute,
    private notify: SnotifyService,
    private jarvis: JarvisService
  ) {
    this.route.queryParams.subscribe(
      params => this.form.restToken = params['token']
    );
  }

  ngOnInit() {
  }
  onSubmit(form) {
    if (!this.form.restToken) {
      this.notify.error('Token not found');
    }
    this.jarvis.changePassword(this.form).subscribe(
      data => this.handleResponce(data),
      error => this.handleError(error),
    );
  }

  handleResponce(data) {

  }
  handleError(error) {

  }

}
