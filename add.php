<div class="col-6">
<div class="card mt-2">
  <div class="card-body">
      <h4 class="header-title">Add Candidate</h4>

      <form action="data/addcandidate.php" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
              <tbody>
                <tr>
                  <td class="bg-light">Assigned Date of Interview:</td>
                  <td><input type="date" style="width:100%;" name="assignedDateOfInterview" required></td>
                </tr>

                <tr>
                  <td class="bg-light">First Name:</td>
                  <td><input type="text"  style="width:100%;" name="firstName" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Last Name:</td>
                  <td><input type="text" style="width:100%;" name="lastName" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Middle Name:</td>
                  <td><input type="text"  style="width:100%;" name="middleName"></td>
                </tr>

                <tr>
                  <td class="bg-light">Mobile Number:</td>
                  <td><input type="text" style="width:100%;" name="mobileNumber" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Confirmation Status:</td>
                  <td>
                    <select name="confirmationStatus" style="width:100%" required>
                    <option name="confirmationStatus" value="">------</option>
                    <option name="confirmationStatus" value="Confirmed">Confirmed</option>
                    <option name="confirmationStatus" value="Rescheduled">Rescheduled</option>
                    <option name="confirmationStatus" value="Did Not Confirm">Did Not Confirm</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Confirmed Date of Interview:</td>
                  <td><input type="date"  style="width:100%;" name="confirmedDateOfInterview" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Location:</td>
                  <td><input type="text" style="width:100%;" name="location" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Source of Leads:</td>
                  <td>
                    <select name="source" style="width:100%" required>
                    <option name="source" value="">------</option>
                    <option name="source" value="Bestjobs Job Posting">Bestjobs Job Posting</option>
                    <option name="source" value="Bestjobs Resume Search">Bestjobs Resume Search</option>
                    <option name="source" value="Better Team">Better Team</option>
                    <option name="source" value="Better Team - Indeed">Better Team - Indeed</option>
                    <option name="source" value="Better Team - Jobs180">Better Team - Jobs180</option>
                    <option name="source" value="Boolean Google Search">Boolean Google Search</option>
                    <option name="source" value="Call Center Jobs PH">Call Center Jobs PH</option>
                    <option name="source" value="CareerJet">CareerJet</option>
                    <option name="source" value="Craiglist">Craiglist</option>
                    <option name="source" value="Datamined Leads">Datamined Leads</option>
                    <option name="source" value="Email">Email</option>
                    <option name="source" value="Facebook Comments">Facebook Comments</option>
                    <option name="source" value="Facebook Groups">Facebook Groups</option>
                    <option name="source" value="Facebook Lead Ads">Facebook Lead Ads</option>
                    <option name="source" value="Facebook Marketplace">Facebook Marketplace</option>
                    <option name="source" value="Facebook Messages">Facebook Messages</option>
                    <option name="source" value="Facebook Messenger Ads">Facebook Messenger Ads</option>
                    <option name="source" value="Facebook Page Info">Facebook Page Info</option>
                    <option name="source" value="Facebook Sign Up">Facebook Sign Up</option>
                    <option name="source" value="Facebook Timeline">Facebook Timeline</option>
                    <option name="source" value="Fastjobs">Fastjobs</option>
                    <option name="source" value="Freshgrad.ph">Freshgrad.ph</option>
                    <option name="source" value="Google Ad Words">Google Ad Words</option>
                    <option name="source" value="Google Search">Google Search</option>
                    <option name="source" value="Grabjobs">Grabjobs</option>
                    <option name="source" value="Hire Me">Hire Me</option>
                    <option name="source" value="Indeed">Indeed</option>
                    <option name="source" value="Indeed - Linked In">Indeed - Linked In</option>
                    <option name="source" value="Instagram DM">Instagram DM</option>
                    <option name="source" value="Itrabaho">Itrabaho</option>
                    <option name="source" value="Jobappmatch">Jobappmatch</option>
                    <option name="source" value="Job Hero">Job Hero</option>
                    <option name="source" value="Jobisjobs">Jobisjobs</option>
                    <option name="source" value="Jobmarket.PH">Jobmarket.PH</option>
                    <option name="source" value="Jobs180">Jobs180</option>
                    <option name="source" value="Jobs180 Resume Search">Jobs180 Resume Search</option>
                    <option name="source" value="Jobsbulletin.ph">Jobsbulletin.ph</option>
                    <option name="source" value="Jobscloud.net">Jobscloud.net</option>
                    <option name="source" value="Jobstreet Job Posting">Jobstreet Job Posting</option>
                    <option name="source" value="Jobstreet Resume Search">Jobstreet Resume Search</option>
                    <option name="source" value="Jora">Jora</option>
                    <option name="source" value="LinkedIn Job Posting">LinkedIn Job Posting</option>
                    <option name="source" value="LinkedIn Resume Search">LinkedIn Resume Search</option>
                    <option name="source" value="Locanto">Locanto</option>
                    <option name="source" value="Monster Job Posting">Monster Job Posting</option>
                    <option name="source" value="Monster Resume Search">Monster Resume Search</option>
                    <option name="source" value="Mynimo">Mynimo</option>
                    <option name="source" value="OLX">OLX</option>
                    <option name="source" value="Pinoyjobs">Pinoyjobs</option>
                    <option name="source" value="Post Job Free">Post Job Free</option>
                    <option name="source" value="Recycled">Recycled</option>
                    <option name="source" value="Referral">Referral</option>
                    <option name="source" value="SMS">SMS</option>
                    <option name="source" value="Twitter DM">Twitter DM</option>
                    <option name="source" value="Website">Website</option>
                    <option name="source" value="Worksvianet">Worksvianet</option>
                    <option name="source" value="Worksvianet Resume Search">Worksvianet Resume Search</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Preferred Means of Communication:</td>
                  <td>
                    <select style="width:100%;" name="preferredCommunication" required>
                      <option name="preferredCommunication" value="">-----</option>
                      <option name="preferredCommunication" value="WhatsApp">WhatsApp</option>
                      <option name="preferredCommunication" value="Viber">Viber</option>
                      <option name="preferredCommunication" value="SMS">SMS</option>
                      <option name="preferredCommunication" value="Messenger">Messenger</option>
                      <option name="preferredCommunication" value="Email">Email</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Email:</td>
                  <td><input type="text" style="width:100%;" name="email"></td>
                </tr>

                <tr>
                  <td class="bg-light">Ad Applied To:</td>
                  <td><input type="text" style="width:100%;" name="adAppliedTo" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Processing Branch:</td>
                  <td><input type="text" style="width:100%;" name="processingBranch" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Remarks:</td>
                  <td><input type="text" style="width:100%;" name="remarks"></td>
                </tr>
              </tbody>
            </table>


        </div>

      <div class="input-group">
      <button type="submit" class="btn btn-primary btn-block mb-3">Save Candidate</button>
      </div>
      </form>
      </div>
      </div>
      </div>
