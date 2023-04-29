import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class EventService {
  private base_url = 'http://localhost:8000/api/v0.1/event/';

  constructor(private http:HttpClient) { }


  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('auth_token');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getEvents(branch: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_event_info/' + branch, { headers: headers });
    return response;
  }
  
  getEvent(branch: string, id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + "get_event_info/" + branch + "/" + id, { headers: headers });
    return response;
  }
  
  getEventPictures(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + "get_event_pictures/" + id, { headers: headers });
    return response;
  }
  
  getAnnouncements(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_announcements/' + id, { headers: headers });
    return response;
  }
  
  getYearlyGoals(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_yearly_goals/' + id, { headers: headers });
    return response;
  }
  
  downloadPic(pictureUrl: string): Observable<string> {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'download_picture_url/' + encodeURIComponent(pictureUrl), { headers: headers, responseType: 'json' });
    return response.pipe(map((res: any) => res.data));
  }

}
