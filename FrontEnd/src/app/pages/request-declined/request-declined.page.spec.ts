import { ComponentFixture, TestBed } from '@angular/core/testing';
import { RequestDeclinedPage } from './request-declined.page';

describe('RequestDeclinedPage', () => {
  let component: RequestDeclinedPage;
  let fixture: ComponentFixture<RequestDeclinedPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(RequestDeclinedPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
