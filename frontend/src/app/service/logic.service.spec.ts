/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { LogicService } from './logic.service';

describe('Service: Logic', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [LogicService]
    });
  });

  it('should ...', inject([LogicService], (service: LogicService) => {
    expect(service).toBeTruthy();
  }));
});
