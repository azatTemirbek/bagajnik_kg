import { JarvisService } from '../../../../service/auth/jarvis.service';
import { Component, OnInit } from '@angular/core';
import { SnotifyService } from 'ng-snotify';

@Component({
  selector: 'app-request-reset',
  templateUrl: './request-reset.component.html',
  styleUrls: ['./request-reset.component.css']
})
export class RequestResetComponent implements OnInit {

  public form = {
    email: null
  };

  constructor(
    private jarvis: JarvisService,
    private notify: SnotifyService
  ) { }

  ngOnInit() {
  }
  onSubmit() {
    this.jarvis
      .sendPasswordResetLink(this.form)
      .subscribe(
        data => this.hendleRespnse(data),
        err => this.notify.error(err.error.message)
      );
  }
  hendleRespnse(res) {
    this.form.email = null;
  }

}
