import { ComponentFixture, TestBed } from '@angular/core/testing';
import { EditGoalPage } from './edit-goal.page';

describe('EditGoalPage', () => {
  let component: EditGoalPage;
  let fixture: ComponentFixture<EditGoalPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(EditGoalPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
