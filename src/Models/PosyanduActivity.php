<?php

namespace Module\Posyandu\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Foundation\Models\FoundationCommunity;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Module\Posyandu\Http\Resources\ActivityResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PosyanduActivity extends Model
{
    use Filterable;
    use HasMeta;
    use HasPageSetup;
    use Searchable;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'platform';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posyandu_activities';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['posyandu-activity'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array'
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
    * mapCombos function
    *
    * @param Request $request
    * @return array
    */
    public static function mapCombos(Request $request): array
    {
        return [
            'services' => PosyanduService::forCombo()
        ];
    }

    /**
     * mapStatuses function
     *
     * @param Request $request
     * @return array
     */
    public static function mapStatuses(Request $request, $model = null): array
    {
        return [
            'hasBeenVerified' => $model ? $model->status === 'VERIFIED' : false,
            'hasBeenRejected' => $model ? $model->status === 'REJECTED' : false,
            'hasBeenCompleted' => $model ? $model->status === 'COMPLETED' : false,
            'hasRecipients' => $model ? $model->recipients->count() > 0 : false,
            'hasComplaints' => $model ? $model->complaints->count() > 0 : false
        ];
    }

    /**
     * mapHeaders function
     *
     * readonly value?: SelectItemKey<any>
     * readonly title?: string | undefined
     * readonly align?: 'start' | 'end' | 'center' | undefined
     * readonly width?: string | number | undefined
     * readonly minWidth?: string | undefined
     * readonly maxWidth?: string | undefined
     * readonly nowrap?: boolean | undefined
     * readonly sortable?: boolean | undefined
     *
     * @param Request $request
     * @return array
     */
    public static function mapHeaders(Request $request): array
    {
        return [
            ['title' => 'Nama Kegiatan', 'value' => 'name'],
            ['title' => 'Bidang', 'value' => 'service_name'],
            ['title' => 'Tanggal', 'value' => 'date'],
            ['title' => 'Anggaran', 'value' => 'budget_formatted'],
            ['title' => 'Lembaga', 'value' => 'community_name'],
            ['title' => 'Desa', 'value' => 'village_name'],
            ['title' => 'Status', 'value' => 'status'],
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResource(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'date' => $model->date,
            'community_name' => $model->community?->name,
            'village_name' => $model->community?->village?->name,
            'service_id' => $model->service_id,
            'service_name' => optional($model->service)->name,
            'participants' => $model->participants,
            'executor' => $model->executor,
            'budget' => floatval(optional($model->funding)->budget),
            'budget_formatted' => number_format(
                floatval(optional($model->funding)->budget),
                0,
                ",",
                "."
            ),
            'status' => $model->status,
            'description' => $model->description
        ];
    }

    /**
     * mapResourceShow function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'date' => $model->date,
            'community_name' => $model->community?->name,
            'village_name' => $model->community?->village?->name,
            'service_id' => $model->service_id,
            'service_name' => optional($model->service)->name,
            'participants' => $model->participants,
            'executor' => $model->executor,
            'budget' => floatval(optional($model->funding)->budget),
            'budget_formatted' => number_format(
                floatval(optional($model->funding)->budget),
                0,
                ",",
                "."
            ),
            'status' => $model->status,
            'complaints' => $model->complaints()->select('name', 'description')->get(),
            'description' => $model->description
        ];
    }

    /**
     * mapRecordBase function
     *
     * @param Request $request
     * @return array
     */
    public static function mapRecordBase(Request $request): array
    {
        return [
            'id' => null,
            'name' => null,
            'date' => null,
            'service_id' => null,
            'community_id' => null,
            'executor' => null,
            'description' => null,
            'participants' => null,
            'workunit_id' => null,
            'status' => null,
            'paths' => PosyanduDocument::whereIn('name', ['Proposal Pengajuan'])
                ->get()->reduce(function ($carry, $document) {
                    array_push($carry, [
                        'id' => $document->id,
                        'name' => $document->name,
                        'slug' => $document->slug,
                        'mime' => $document->mime,
                        'extension' => optional($document)->extension ?: '.pdf',
                        'maxsize' => $document->maxsize,
                        'path' => null
                    ]);

                    return $carry;
                }, []),
            'user_id' => null,
        ];
    }


    /**
     * scopeForCurrentUser function
     *
     * @param Builder $query
     * @param [type] $user
     * @return Builder|null
     */
    public function scopeForCurrentUser(Builder $query, $user): Builder|null
    {
        if ($user->hasLicenseAs('posyandu-admin-desa')) {
            return $query
                ->where('village_id', $user?->userable?->village_id);
        }

        if ($user->hasLicenseAs('posyandu-admin-kecamatan')) {
            if ($workunit = $user?->userable?->workunitable) {
                return $query
                    ->whereIn(
                        'village_id',
                        $workunit->descendants()->pluck('village_id')
                    );
            }

            return null;
        }

        if ($user->hasLicenseAs('posyandu-admin-opd')) {
            return $query
                ->where('village_id', $user?->userable?->village_id)
                ->where('workunit_id', $user?->userable?->workunitable_id);
        }

        return $query;
    }

    /**
     * community function
     *
     * @return BelongsTo
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(FoundationCommunity::class, 'community_id');
    }

    /**
     * complaints function
     *
     * @return BelongsToMany
     */
    public function complaints(): BelongsToMany
    {
        return $this->belongsToMany(
            PosyanduComplaint::class,
            'posyandu_premises',
            'activity_id',
            'complaint_id'
        );
    }

    /**
     * foundings function
     *
     * @return HasOne
     */
    public function funding(): HasOne
    {
        return $this->hasOne(PosyanduFunding::class, 'activity_id');
    }

    /**
     * complaints function
     *
     * @return BelongsToMany
     */
    public function premises(): BelongsToMany
    {
        return $this->belongsToMany(
            PosyanduComplaint::class,
            'posyandu_premises',
            'activity_id',
            'complaint_id'
        );
    }

    /**
     * recipients function
     *
     * @return BelongsToMany
     */
    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(
            PosyanduBeneficiary::class,
            'posyandu_recipients',
            'activity_id',
            'beneficiary_id'
        );
    }

    /**
     * service function
     *
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(PosyanduService::class, 'service_id');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        $model = new static();

        DB::connection($model->connection)->beginTransaction();

        try {
            // ...
            $model->save();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            // ...
            $model->save();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deleteRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->delete();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model restore method
     *
     * @param [type] $model
     * @return void
     */
    public static function restoreRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->restore();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model destroy method
     *
     * @param [type] $model
     * @return void
     */
    public static function destroyRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->forceDelete();

            DB::connection($model->connection)->commit();

            return new ActivityResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
