import { LuggageService } from './service/luggage.service';
import { TripService } from './service/trip.service';
import { TokenService } from './service/token.service';
import { JarvisService } from './service/jarvis.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { ProfileComponent } from './components/profile/profile.component';
import { RequestResetComponent } from './components/password/request-reset/request-reset.component';
import { ResponceResetComponent } from './components/password/responce-reset/responce-reset.component';
import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from '@angular/common/http';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { SnotifyModule, SnotifyService, ToastDefaults } from 'ng-snotify';
import { HomePageComponent } from './components/home-page/home-page.component';
import { OfferService } from './service/offer.service';
import { TripsComponent } from './pages/trips/trips.component';
import { DynamicFormsCoreModule } from '@ng-dynamic-forms/core';
import { DynamicFormsNGBootstrapUIModule } from '@ng-dynamic-forms/ui-ng-bootstrap';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';




@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    LoginComponent,
    RegisterComponent,
    ProfileComponent,
    RequestResetComponent,
    ResponceResetComponent,
    PageNotFoundComponent,
    HomePageComponent,
    TripsComponent,
  ],
  imports: [
    FormsModule,
    NgbModule,
    SnotifyModule,
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    DynamicFormsCoreModule,
    DynamicFormsNGBootstrapUIModule
  ],
  providers: [
    JarvisService,
    TokenService,
    { provide: 'SnotifyToastConfig', useValue: ToastDefaults},
    SnotifyService,
    OfferService,
    TripService,
    LuggageService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
