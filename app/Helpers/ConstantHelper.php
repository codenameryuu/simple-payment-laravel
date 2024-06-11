<?php

namespace App\Helpers;

class ConstantHelper
{
    /**
     ** Bpjs type.
     *
     * @return Array
     */
    public static function bpjsType()
    {
        $result = [
            'Tidak Ada',
            'Penambah',
            'Pengurang',
        ];

        return $result;
    }

    /**
     ** Gender.
     *
     * @return Array
     */
    public static function gender()
    {
        $result = [
            'Laki-laki',
            'Perempuan',
        ];

        return $result;
    }

    /**
     ** Religion.
     *
     * @return Array
     */
    public static function religion()
    {
        $result = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Budha',
        ];

        return $result;
    }

    /**
     ** Education.
     *
     * @return Array
     */
    public static function education()
    {
        $result = [
            'SD',
            'SMP',
            'SMA',
            'SMK',
            'S1',
            'S2',
            'S3',
        ];

        return $result;
    }

    /**
     ** Employee status.
     *
     * @return Array
     */
    public static function employeeStatus()
    {
        $result = [
            'Pegawai Kontrak',
            'Pegawai Tetap',
            'Resign',
        ];

        return $result;
    }

    /**
     ** Recruitment status.
     *
     * @return Array
     */
    public static function recruitmentStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Absence submission category.
     *
     * @return Array
     */
    public static function absenceSubmissionCategory()
    {
        $result = [
            'Izin',
            'Sakit',
        ];

        return $result;
    }

    /**
     ** Absence submission status.
     *
     * @return Array
     */
    public static function absenceSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Overtime submission status.
     *
     * @return Array
     */
    public static function overtimeSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Resignation submission status.
     *
     * @return Array
     */
    public static function resignationSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Business trip submission status.
     *
     * @return Array
     */
    public static function businessTripSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Promotion mutation submission status.
     *
     * @return Array
     */
    public static function promotionMutationSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Holiday allowance submission status.
     *
     * @return Array
     */
    public static function holidayAllowanceSubmissionStatus()
    {
        $result = [
            'Menunggu Persetujuan',
            'Disetujui',
            'Ditolak',
        ];

        return $result;
    }

    /**
     ** Schedule status.
     *
     * @return Array
     */
    public static function scheduleStatus()
    {
        $result = [
            'Hadir',
            'Tidak Hadir',
        ];

        return $result;
    }

    /**
     ** Absence submission category.
     *
     * @return Array
     */
    public static function scheduleAbsenceCategory()
    {
        $result = [
            'Tanpa Keterangan',
            'Izin',
            'Sakit',
        ];

        return $result;
    }
}
