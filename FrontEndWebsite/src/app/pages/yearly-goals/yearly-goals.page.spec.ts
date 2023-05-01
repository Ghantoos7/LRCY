import { ComponentFixture, TestBed } from '@angular/core/testing';
import { YearlyGoalsPage } from './yearly-goals.page';

describe('YearlyGoalsPage', () => {
  let component: YearlyGoalsPage;
  let fixture: ComponentFixture<YearlyGoalsPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(YearlyGoalsPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
