import { ComponentFixture, TestBed } from '@angular/core/testing';
import { DeleteTrainingPage } from './delete-training.page';

describe('DeleteTrainingPage', () => {
  let component: DeleteTrainingPage;
  let fixture: ComponentFixture<DeleteTrainingPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(DeleteTrainingPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
