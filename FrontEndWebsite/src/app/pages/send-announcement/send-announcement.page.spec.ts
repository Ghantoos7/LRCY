import { ComponentFixture, TestBed } from '@angular/core/testing';
import { SendAnnouncementPage } from './send-announcement.page';

describe('SendAnnouncementPage', () => {
  let component: SendAnnouncementPage;
  let fixture: ComponentFixture<SendAnnouncementPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(SendAnnouncementPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
