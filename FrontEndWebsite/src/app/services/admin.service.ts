import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  constructor(private http:HttpClient) { }

  base_url = "http://localhost:8000/api/v0.1/admin/";
  base_url_event = "http://localhost:8000/api/v0.1/event/";

  private getAuthHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
  
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });
  
    return headers;
  }

  getRequests(branch_id: string){
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url + 'get_requests/' + branch_id, { headers: headers });
    return response;
  }

  acceptRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'accept_request', body, options);
      return response;
  }

  declineRequest(request_id: string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
      const options = { headers: headers };
    
      const body = {
        'request_id': request_id
      };
    
      const response = this.http.post(this.base_url + 'decline_request', body, options);
      return response;
  }

  getAnnouncements(id: string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_announcements/' + id, { headers: headers });
    return response;
  }

  sendAnnouncement(title: string, content: string, importance_level: string, id: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_title': title,
      'announcement_content': content,
      'importance_level': importance_level,
      'admin_id': id
    };

    const response = this.http.post(this.base_url + 'send_announcement', body, options);
    return response;
  }

  deleteAnnouncement(announcement_id: string, admin_id: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_id': announcement_id,
      'admin_id': admin_id
    };

    const response = this.http.post(this.base_url + 'delete_announcement', body, options);
    return response;
  }

  editAnnouncement(announcement_id: string, admin_id: string, title: string, content: string, importance_level: string) {
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'announcement_id': announcement_id,
      'admin_id': admin_id,
      'announcement_title': title,
      'announcement_content': content,
      'importance_level': importance_level
    };

    const response = this.http.post(this.base_url + 'edit_announcement', body, options);
    return response;
  }

  getYearlyGoals(branch_id: string, goal_id : string) {
    const headers = this.getAuthHeaders();
    const response = this.http.get(this.base_url_event + 'get_yearly_goals/' + branch_id + "/" + goal_id, { headers: headers });
    return response;
  }

  deleteYearlyGoal(goal_id: string) {
    const headers = this.getAuthHeaders();
    const body = { goal_id: goal_id };
    const response = this.http.post(this.base_url + 'delete_yearly_goal', body, { headers: headers });
    return response;
}

  editYearlyGoal(goal_id : number, branch_id : number, goal_name : string, goal_description : string, number_completed: number, number_to_complete: number, program_id:number, event_type_id:number, goal_year : number, start_date:string, goal_deadline:string ){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      'goal_id': goal_id,
      'branch_id': branch_id,
      'goal_name': goal_name,
      'goal_description': goal_description,
      'number_completed': number_completed,
      'number_to_complete': number_to_complete,
      'program_id': program_id,
      'event_type_id': event_type_id,
      'goal_year': goal_year,
      'start_date': start_date,
      'goal_deadline': goal_deadline
    };

    const response = this.http.post(this.base_url + 'edit_yearly_goal', body, options);
    return response;
  }

  setYearlyGoal(branch_id : number, goal_name : string, goal_description : string, number_to_complete: number, program_id:number, event_type_id:number, goal_year : number, start_date:string, goal_deadline:string){
    const headers = this.getAuthHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };
  
    const body = {
      'branch_id': branch_id,
      'goal_name': goal_name,
      'goal_description': goal_description,
      'number_to_complete': number_to_complete, // Change this line
      'program_id': program_id,
      'event_type_id': event_type_id,
      'goal_year': goal_year,
      'start_date': start_date,
      'goal_deadline': goal_deadline
    };
  
    const response = this.http.post(this.base_url + 'set_yearly_goal', body, options);
    return response;
  }


}
