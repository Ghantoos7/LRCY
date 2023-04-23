import { ComponentFixture, TestBed } from '@angular/core/testing';
import { AddTrainingPage } from './add-training.page';

describe('AddTrainingPage', () => {
  let component: AddTrainingPage;
  let fixture: ComponentFixture<AddTrainingPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(AddTrainingPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
