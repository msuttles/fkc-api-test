<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;
use Illuminate\Support\Facades\Mail;

class Source
{
  protected $source = false;
  protected $table_name = false;
  protected $insert_params = false;
  protected $pdo;

  public function __construct()
  {
    $this->table_name = $this->source . '_data';

    $db = new DBConnection;
    $this->pdo = $db->connect();
    $this->env_emails = env('MAIL_EMAILS');
    $this->get_emails = explode(";", $this->env_emails);
  }

  public function alterTableAutoIncrement($last_insert_id)
  {
    $next_id = $last_insert_id+1;
    $this->pdo->query("ALTER TABLE " . $this->table_name . " AUTO_INCREMENT = " . $next_id);
  }

  public function getLastInsertId()
  {
    $results = $this->pdo->query("SELECT `Unique ID` FROM " . $this->table_name . " ORDER BY `Unique ID` DESC LIMIT 1");
    $results = $results->fetchAll(\PDO::FETCH_OBJ);

    return $results[0]->{'Unique ID'};
  }

  public function setAutoId($gid)
  {
    try {
      $query = $this->pdo->prepare("UPDATE sources SET last_end_id = :last_id WHERE source = :source");
      $query->execute([':last_id' => $gid, ':source' => $this->source]);
    } catch (\PDOException $e) {
      //echo "Error: ".$e;
      abort(500, "Error: ".$e);

      // send email notifications
      $report = "Source error: {$e}";

      foreach($this->get_emails as $email) {
        Mail::raw($report, function($msg) use ($email) {
          $msg->to($email);
          $msg->from(['datamart@wunderman.com']);
        });
      }
    }
  }

  public function setCampaignIds($source)
  {
    // pull current campaign ids from table
    $sql = "SELECT * FROM ".$source."_campaign_ids";
    $CampaignIDs = $this->pdo->query($sql);
    $CampaignIDs = $CampaignIDs->fetchAll(\PDO::FETCH_OBJ);

    // update all current data to use correct campaign id
    foreach($CampaignIDs as $record) {
      if ($source == 'ga') {
        try {
          $query = $this->pdo->prepare('UPDATE ' . $this->table_name . ' SET `Campaign Id` = :id WHERE `Campaign Name` = :name ');
          $query->execute([':id' => $record->id, ':name' => $record->name]);
        } catch (\PDOException $e){
          //echo "Error: ".$e;
          abort(500, "Error: ".$e);

          // send email notifications
          $report = "Source error: {$e}";

          foreach($this->get_emails as $email) {
            Mail::raw($report, function($msg) use ($email) {
              $msg->to($email);
              $msg->from(['datamart@wunderman.com']);
            });
          }
        }
      } elseif ($source == 'dcm') {
        try {
          $query = $this->pdo->prepare('UPDATE ' . $this->table_name . ' SET `Campaign ID` = :id WHERE `Campaign Name` = :name ');
          $query->execute([':id' => $record->id, ':name' => $record->campaign]);
        } catch (\PDOException $e) {
          //echo "Error: ".$e;
          abort(500, "Error: ".$e);

          // send email notifications
          $report = "Source error: {$e}";

          foreach($this->get_emails as $email) {
            Mail::raw($report, function($msg) use ($email) {
              $msg->to($email);
              $msg->from(['datamart@wunderman.com']);
            });
          }
        }
      } elseif ($source == 'fb') {
        try {
          $query = $this->pdo->prepare('UPDATE ' . $this->table_name . ' SET `Campaign ID` = :id WHERE `Campaign Name` = :name ');
          $query->execute([':id' => $record->id, ':name' => $record->campaign]);
        } catch (\PDOException $e) {
          //echo "Error: ".$e;
          abort(500, "Error: ".$e);

          // send email notifications
          $report = "Source error: {$e}";

          foreach($this->get_emails as $email) {
            Mail::raw($report, function($msg) use ($email) {
              $msg->to($email);
              $msg->from(['datamart@wunderman.com']);
            });
          }
        }
      } elseif ($source == 'dt') {
        if($record->url_tag != ""){
          try {
            $query = $this->pdo->prepare('UPDATE ' . $this->table_name . ' SET `Campaign Id` = :id WHERE `URL Tag` = :url_tag ');
            $query->execute([':id' => $record->id, ':url_tag' => $record->url_tag]);
          } catch (\PDOException $e) {
            //echo "Error: ".$e;
            abort(500, "Error: ".$e);

            // send email notifications
            $report = "Source error: {$e}";

            foreach($this->get_emails as $email) {
              Mail::raw($report, function($msg) use ($email) {
                $msg->to($email);
                $msg->from(['datamart@wunderman.com']);
              });
            }
          }
        }
      } elseif ($source == 'ds') {
        try {
          $query = $this->pdo->prepare('UPDATE ' . $this->table_name . ' SET `Campaign ID` = :id WHERE `Campaign` = :campaign ');
          $query->execute([':id' => $record->id, ':campaign' => $record->campaign]);
        } catch (\PDOException $e) {
          //echo "Error: ".$e;
          abort(500, "Error: ".$e);

          // send email notifications
          $report = "Source error: {$e}";

          foreach($this->get_emails as $email) {
            Mail::raw($report, function($msg) use ($email) {
              $msg->to($email);
              $msg->from(['datamart@wunderman.com']);
            });
          }
        }
      }
    }
  }

  public function insert($data)
  {
    try {
      $sql = 'INSERT INTO ' . $this->table_name . ' ' . $this->insert_params;

      $query = $this->pdo->prepare($sql);

      $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

      foreach($data as $record) {
        $record = $this->formatParams($record);
        $query->execute($record);
      }
    } catch (\PDOException $e){
      //echo "Error: ".$e;
      abort(500, "Error: ".$e);

      // send email notifications
      $report = "Source error: {$e}";

      foreach($this->get_emails as $email) {
        Mail::raw($report, function($msg) use ($email) {
          $msg->to($email);
          $msg->from(['datamart@wunderman.com']);
        });
      }
    }
  }

  public function truncate()
  {
    // Create connection and truncate
    $conn = $this->pdo->query('TRUNCATE ' . $this->table_name);
  }

  protected function formatParams($row_data)
  {
    // do nothing by default
  }
}
