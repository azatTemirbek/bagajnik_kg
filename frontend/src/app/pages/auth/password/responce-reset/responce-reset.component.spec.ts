import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ResponceResetComponent } from './responce-reset.component';

describe('ResponceResetComponent', () => {
  let component: ResponceResetComponent;
  let fixture: ComponentFixture<ResponceResetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ResponceResetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ResponceResetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
