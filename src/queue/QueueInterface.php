<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 */

namespace craft\queue;

/**
 * QueueInterface defines the common interface to be implemented by queue classes.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0.0
 */
interface QueueInterface
{
    /**
     * Runs all the queued-up jobs.
     */
    public function run();

    /**
     * Re-adds a failed job to the queue.
     *
     * @param string $id
     */
    public function retry(string $id);

    /**
     * Retries all failed jobs.
     *
     * @since 3.4.0
     */
    public function retryAll();

    /**
     * Releases all jobs.
     *
     * @since 3.4.0
     */
    public function releaseAll();

    /**
     * Releases a job from the queue.
     *
     * @param string $id
     */
    public function release(string $id);

    /**
     * Sets the progress for the currently reserved job.
     *
     * @param int $progress The job progress (1-100)
     * @param string|null $label The progress label
     */
    public function setProgress(int $progress, string $label = null);

    /**
     * Returns whether there are any waiting jobs.
     *
     * @return bool
     */
    public function getHasWaitingJobs(): bool;

    /**
     * Returns whether there are any reserved jobs.
     *
     * @return bool
     */
    public function getHasReservedJobs(): bool;

    /**
     * Returns info about the jobs in the queue.
     *
     * The response array should have sub-arrays with the following keys:
     *
     * - `id` – the job ID
     * - `status` – the job status (1 = waiting, 2 = reserved, 3 = done, 4 = failed)
     * - `progress` – the job progress (0-100)
     * - `description` – the job description
     * - `error` – the error message (if the job failed)
     *
     * @param int|null $limit
     * @return array
     */
    public function getJobInfo(int $limit = null): array;

    /**
     * Returns all possible information on a single queue job.
     *
     * In the QueueUtility this method is used to display details about your queue job.
     * The key `job` will be displayed in a <code></code> tag and should return the raw debug data about your queue.
     * The key `error` will be displayed in red indicating a problem with the job.
     * The key `status` should return the status in accordance with `self::getJobInfo().
     * The key `progress` should return the job progress (0-100).
     * The key `description` should return the description of the job
     *
     * Any other key value pairs are allowed and will be displayed on the details page.
     *
     * @param string $id
     * @return array
     * @since 3.4.0
     */
    public function getJobDetails(string $id): array;
}
