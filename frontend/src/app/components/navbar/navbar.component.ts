import { TokenService } from 'src/app/service/token.service';
import { Router } from '@angular/router';
import { AuthService } from './../../service/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  constructor(
    public Auth: AuthService,
    private route: Router,
    private  Token: TokenService
    ) { }

  ngOnInit() {
  }
  logout(){
    this.Auth.loggedIn.next(!this.Auth.loggedIn.getValue());
    this.route.navigateByUrl('/login');
    this.Token.remove();
  }

}
