import { LuggagesComponent } from './pages/luggages/luggages.component';
import { LuggageService } from './service/luggage.service';
import { TripService } from './service/trip.service';
import { TokenService } from './service/auth/token.service';
import { JarvisService } from './service/auth/jarvis.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { LoginComponent } from './pages/auth/login/login.component';
import { RegisterComponent } from './pages/auth/register/register.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { RequestResetComponent } from './pages/auth/password/request-reset/request-reset.component';
import { ResponceResetComponent } from './pages/auth/password/responce-reset/responce-reset.component';
import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from '@angular/common/http';
import { PageNotFoundComponent } from './pages/page-not-found/page-not-found.component';
import { SnotifyModule, SnotifyService, ToastDefaults } from 'ng-snotify';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { OfferService } from './service/offer.service';
import { TripsComponent } from './pages/trips/trips.component';
import { DynamicFormsCoreModule } from '@ng-dynamic-forms/core';
import { DynamicFormsNGBootstrapUIModule } from '@ng-dynamic-forms/ui-ng-bootstrap';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {InfiniteScrollModule} from 'ngx-infinite-scroll';
import { TripFormComponent } from './pages/form/trip-form/trip-form.component';
import { JumbotronComponent } from './components/Jumbotron/Jumbotron.component';
import { FooterComponent } from './components/footer/footer.component';
import { LuggageFormComponent } from './pages/form/luggage-form/luggage-form.component';




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
    LuggagesComponent,
    TripFormComponent,
    JumbotronComponent,
    FooterComponent,
    LuggageFormComponent
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
    DynamicFormsNGBootstrapUIModule,
    InfiniteScrollModule,
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
